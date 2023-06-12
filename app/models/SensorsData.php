<?php
require_once "connect.php";
require_once "ErrorsHandler.php";

/**
 * The SensorsManager class retrieves data from ISEP server, processes the raw data received, and stores it in a local database.
 * This class is used to fetch logs, store sensor data, and get sensor data by type for further processing.
 *
 * Constants to change:
 *  TEAM_NUMBER : Identifies the team number associated with the data. (string)
 *  SENSORS_MAP : An associative array containing sensor types mapped to their respective sensor IDs. (array)
 *
 * Methods:
 *  getLogs() : Fetches the logs from the ISEP server and processes them. (array)
 *  storeUsefullLogs($sensorID, $value, $date) : Stores a sensor entry in the database. (void)
 *  getSensorData($sensorType) : Returns JSON encoded array containing values of a specific sensor type. (string) * @throws Exception when invalid sensor type is provided.
 */


class SensorsManager
{
    const TEAM_NUMBER = "0008";
    const SENSORS_MAP = ["sound" => 1, "bpm" => 2, "hum" => 3, "temp" => 4];

    public function getLogs()
    {
        try {
            $ch = curl_init();
            curl_setopt(
                $ch,
                CURLOPT_URL,
                "http://projets-tomcat.isep.fr:8080/appService?ACTION=GETLOG&TEAM=" . self::TEAM_NUMBER);
            curl_setopt($ch, CURLOPT_HEADER, FALSE);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            $logs = curl_exec($ch);
            curl_close($ch);
        } catch (Exception $e) {
            ErrorsHandler::newError("Failed to fetch data from ISEP server : " . $e->getMessage() . ". Please check that ISEP correctly opened port 22 👀👀", 1, true);
        }

        echo 'logs';
        var_dump($logs);

        $data_tab = str_split($logs, 33);
        $trame = $data_tab[1];
        $result = sscanf($trame, "%1s%4s%1s%1s%2s%4s%4s%2s%4s%2s%2s%2s%2s%2s");

        exit();

        $data = [
            'frame' => $result[0], #type de trame : 1 = trame courante, 2 = trame rapide
            'object' => $result[1], #numéro d'équipe
            'type' => $result[2], #type de requète : 1 = récupérer la donnée d’un capteur, 2 = envoyer une commande à un effecteur
            'sensorID' => $result[3], #type de capteur
            'sensorNumber' => $result[4], #numéro du capteur : toujours 01
            'value' => hexdec($result[5]), # valeur du capteur (convertie de hex a dec)
            'frameID' => $result[6], #numero de la trame
            'checksum' => $result[7], #checksum (useless)
        ];

        $dateString = $result[10] . "-" . $result[9] . "-" . $result[8] . " " . $result[11] . ":" . $result[12] . ":" . $result[13] . "GMT";
        $date = date_create($dateString);
        $data["date"] = $date;

        $this->storeUsefullLogs($data["sensorID"], $data["value"], $data["date"]);
        return $data;
    }

    private function storeUsefullLogs($sensorID, $value, $date)
    {
        database_query("INSERT INTO sensorsData (`sensorID`, `value`, `date`) VALUES ($sensorID, $value, '$date')");
    }

    public function getSensorData($sensorType)
    {
        if (!isset(self::SENSORS_MAP[$sensorType])) return json_encode("Invalid sensor type");

        $sensorID = self::SENSORS_MAP[$sensorType];
        $results = database_query("SELECT `value` FROM sensorsData WHERE `sensorID` = $sensorID ORDER BY `date` ASC");

        $values = [];
        foreach ($results as $result) {
            $values[] = $result['value'];
        }
        return json_encode($values);
    }

}