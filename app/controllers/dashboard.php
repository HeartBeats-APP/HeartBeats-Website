<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/app/models/AccountManager.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/app/models/SensorsData.php');

class dashboard extends Controller
{
    public function index()
    {
        if (!AccountManager::isSessionActive()) {
            header('Location: /account/login');
            exit();
        }
        $data = AccountManager::getSessionData();
        $this->header();
        $this->view('dashboard/dashboard', $data);
        $this->footer();
    }

    public function getData()
    {
        $sensor = $_REQUEST['sensor'];
        $refresh = $_REQUEST['refresh'];

        $sensorsManager = new SensorsManager();
        if ($refresh) {
            $sensorsManager->getLogs();
        }

        if ($sensor) {
            $sensorDatas = $sensorsManager->getSensorData($sensor);
            echo $sensorDatas;
        }
    }
}