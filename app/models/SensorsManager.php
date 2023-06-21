<?php
require_once('connect.php');

/**
 * Class SensorsManager
 *
 * This class manages sensor data fetching from ISEP server and accessing or storing the data in a database. Supports sensor types
 * "sound", "bpm", "humidity" and "temperature".
 *
 * Main methods:
 * - getLogs(): Fetches sensor data logs from ISEP server, processes them and inserts non-duplicate entries into the database.
 * - getSensorData($sensorType): Returns an array of sensor data values for the given sensor type, sorted by date.
 *
 * Constants:
 * - TEAM_NUMBER: Defines the team number that identifies the sensor data originating from this team.
 * - SENSORS_MAP: Maps sensor types to their respective numerical IDs.
 */

class SensorsManager
{
    const TEAM_NUMBER = "GG8E";
    const SENSORS_MAP = ["sound" => 1, "bpm" => 2, "hum" => 3, "temp" => 4];
    private $conn;

    public function getLogs()
    {

        try {
            $logs = file_get_contents("http://projets-tomcat.isep.fr:8080/appService?ACTION=GETLOG&TEAM=" . self::TEAM_NUMBER);
        } catch (Exception $e) {
            return "Failed to fetch data from ISEP server : " . $e->getMessage() . ". Please check that ISEP correctly opened port 22 👀👀";
        }

        if (!$logs) {
            return "Failed to fetch data from ISEP server. Please check that ISEP correctly opened port 22 👀👀";
        }

        // The frame size is inconsistent, therefore the provided code from ISEP is not reliable. We need to identify the pattern where each frame begins with the number 1 followed by our team number. By utilizing this pattern, we can effectively locate the desired frame.
        $pattern = '/1' . self::TEAM_NUMBER . '.*?(?=1' . self::TEAM_NUMBER . '|$)/s';
        preg_match_all($pattern, $logs, $matches);
        $foundFrames = $matches[0];

        $this->openDbConnection();
        foreach ($foundFrames as $frame) {
            $sensorInfos = $this->processFrame($frame);
            if ($sensorInfos) {
                $this->insertInfosInDb($sensorInfos[0], $sensorInfos[1], $sensorInfos[2]);
            }
        }
        $this->closeDbConnection();
        return "OK";
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

    public function sendFrame($frame)
    {
        try {
             $result = file_get_contents("http://projets-tomcat.isep.fr:8080/appService?ACTION=COMMAND&TEAM=" . self::TEAM_NUMBER . "&TRAME=" . $frame);
        } catch (Exception $e) {
            echo "Failed to send data to ISEP server : " . $e->getMessage();
            return false;
        }
        
        $result = trim($result);
        if ($result != "Commande envoyée") {
            echo "Data was not processed by ISEP server : " . $result;
            return false;
        }
        return true;
    }

    public function createFrame($action)
    {   
        $frameType = "1";
        $requestType = "2";
        $sensorID = "0";
        $sensorNumber = "01";
        $value = str_pad($action, 4, "0", STR_PAD_LEFT);

        $checksum = "11";

        return $frameType . self::TEAM_NUMBER . $requestType . $sensorID . $sensorNumber . $value . $checksum;
    }

    private function processFrame($frame)
    {
        $data = sscanf($frame, "%1s%4s%1s%1s%2s%4s%4s%2s%4s%2s%2s%2s%2s%2s");
        $sensorValue = hexdec($data[5]);
        $sensorID = $data[3];

        if ($data[0] != "1" && $data[0] != "2") {
            return null;
        }

        if ($data[1] != self::TEAM_NUMBER) {
            return null;
        }

        if ($data[2] != "1") {
            return null;
        }

        if ($this->isDateCorrect($data[8], $data[9], $data[10], $data[11], $data[12], $data[13])) {
            $date = date_create($data[8] . "-" . $data[9] . "-" . $data[10] . " " . $data[11] . ":" . $data[12] . ":" . $data[13]);
        } else {
            $date = new DateTime();
        }

        if ($sensorValue <= 0) {
            return null;
        }

        return [$sensorID, $sensorValue, $date];
    }

    private function insertInfosInDb($sensorID, $value, $date)
    {
        $stmt = $this->conn->prepare("SELECT * FROM sensorsData WHERE sensorID = :sensorID AND value = :value AND date = :date");
        $stmt->bindParam(':sensorID', $sensorID, PDO::PARAM_INT);
        $stmt->bindParam(':value', $value, PDO::PARAM_INT);
        $stmt->bindParam(':date', $date->format('Y-m-d H:i:s'), PDO::PARAM_STR);
        $stmt->execute();

        if ($stmt->rowCount() == 0) {
            $stmt = $this->conn->prepare("INSERT INTO sensorsData (sensorID, value, date) VALUES (:sensorID, :value, :date)");
            $stmt->bindParam(':sensorID', $sensorID, PDO::PARAM_INT);
            $stmt->bindParam(':value', $value, PDO::PARAM_INT);
            $stmt->bindParam(':date', $date->format('Y-m-d H:i:s'), PDO::PARAM_STR);
            $stmt->execute();
        }
    }

    private function openDbConnection()
    {
        $host = getenv('DB_HOST');
        $username = getenv('DB_USERNAME');
        $password = getenv('DB_PASSWORD');
        $dbname = getenv('DB_NAME');

        try {
            $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Database connexion failed :/ " . $e->getMessage());
        }
        $this->conn = $conn;
    }

    private function closeDbConnection()
    {
        $this->conn = null;
    }

    private function isDateCorrect($year, $month, $day, $hours, $min, $seconds)
    {
        if ($year === null || $month === null || $day === null || $hours === null || $min === null || $seconds === null) {
            return false; // At least one value is null
        }

        if (!checkdate($month, $day, $year)) {
            return false; // Invalid date
        }


        if ($hours < 0 || $hours > 23 || $min < 0 || $min > 59 || $seconds < 0 || $seconds > 59) {
            return false;
        }

        return true;
    }
}
