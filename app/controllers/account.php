<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/app/models/InputValidator.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/app/models/AccountManager.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/app/models/DeviceManager.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/app/models/ErrorsHandler.php');

class account extends Controller
{

    public function index()
    {
        $this->header();
        $this->view('account/login');
    }

    public function login()
    {
        $this->account();
    }

    public function register()
    {
        $this->header();
        $this->view('account/register');
    }

    public function user()
    {
        $data = AccountManager::getSessionData();
        if (DeviceManager::isDeviceExists()) {
            $deviceData = DeviceManager::getDeviceData();
            $data['device id'] = $deviceData['device id'];
            $data['added date'] = $deviceData['added date'];
            $data['device mode'] = $deviceData['device mode'];
            $data['device connected'] = $deviceData['isDeviceConnected'];
            $data['hasDevice'] = true;
        } else {
            $data['hasDevice'] = false;
        }
        $this->account($data);
    }

    public function admin($args = [])
    {   
        $data = AccountManager::getSessionData();
        $this->account($data, "admin");

        if ($args == 'updates'){
            $data2 = $this->getUpdatesInfo();
            $this->popup($data2);
        }
    }

    public function logUserIn()
    {   

        $email = trim($_REQUEST['email']);
        $password = trim($_REQUEST['password']);

        $emailInput = new EmailInput;
        $emailResult = $emailInput->validate($email);
        $passwordInput = new PasswordInput;
        $passwordResult = $passwordInput->validate($password);

        if ($emailResult || $passwordResult ) {
            echo json_encode(array('result' => 'InputsError', 'emailErrorMessage' => $emailResult, 'passwordErrorMessage' => $passwordResult));
            return;
        }

        $login = new Login;
        $loginResult = $login->logUserIn($email, $password);

        if ($loginResult != "") {
            echo json_encode(array('result' => 'LoginError', 'emailErrorMessage' => $loginResult, 'passwordErrorMessage' => ""));
            return ;
        }
        echo true;
    }

    public function logUserOut()
    {
        if (AccountManager::destroySession() == true) {
            echo true;
            return ;
        }

        ErrorsHandler::newError('Something went wrong while logging out' . AccountManager::getMail(), 1, true);
    }

    public function registerUser()
    {   

        $name = trim($_REQUEST['name']);
        $email = trim($_REQUEST['email']);
        $password = $_REQUEST['password'];
        $passwordConfirm = $_REQUEST['passwordConfirmation'];
        $zxcvbn = $_REQUEST['zxcvbnSS'];

        $nameInput = new NameInput;
        $nameResult = $nameInput->validate($name);
        $emailInput = new EmailInput;
        $emailResult = $emailInput->validate($email);
        $passwordInput = new PasswordInput;
        $passwordResult = $passwordInput->validate($password, $zxcvbn);
        $passwordConfirmResult = $passwordInput->validate($passwordConfirm, $zxcvbn);

        if ($nameResult != "" || $emailResult != "" || $passwordResult != "" || $passwordConfirmResult != "") {
            echo json_encode(array('result' => 'InputsError', 'nameErrorMessage' => $nameResult, 'emailErrorMessage' => $emailResult, 'passwordErrorMessage' => $passwordResult, 'passwordConfirmErrorMessage' => $passwordConfirmResult));
            return ;
        }

        $register = new Register;
        $registerResult = $register->registerUser($name, $email, $password, $passwordConfirm);

        if ($registerResult != "") {
            echo json_encode(array('result' => 'RegisterError', 'emailErrorMessage' => $registerResult));
            return ;
        }

        echo true;
    }

    public function changePassword()
    {
        $this->header();
        $this->view('account/password-recovery');
    }

    public function changeEmail()
    {
    }

    public function changeName()
    {
    }

    public function getNewPassword()
    {
        echo 'function not supported yet :/';
    }

    public function registerDevice()
    {
  
        if (!AccountManager::isSessionActive()) {
            echo json_encode(array('errorMessage' => 'It seems that you are not logged in'));
            AccountManager::destroySession();
            return;
        }
        
        if (DeviceManager::isDeviceExists()) {
            echo json_encode(array('errorMessage' => 'You already have a device'));
            return;
        }

        $serialNumber = $_REQUEST['serial'];
        $purshaseDate = $_REQUEST['date'];

        $serialNumberInput = new SerialNumberInput;
        $serialNumberResult = $serialNumberInput->validate($serialNumber);

        if ($serialNumberResult != "") {
            echo json_encode(array('errorMessage' => $serialNumberResult));
            return;
        }

        $Device = new Device;
        $registerResult = $Device->addNew($serialNumber, $purshaseDate);

        if ($registerResult != "") {
            echo json_encode(array('errorMessage' => $registerResult));
            return;
        }

        echo true;
    }

    public function deleteDevice()
    {
        if (!AccountManager::isSessionActive()) {
            echo "It seems that you are not logged in";
            AccountManager::destroySession();
            return;
        }

        if (!DeviceManager::isDeviceExists()) {
            echo "You don't own a device";
            return;
        }

        $Device = new Device;
        $deleteResult = $Device->remove();

        if ($deleteResult != "") {
            echo $deleteResult;
            return;
        }

        echo true;
    }

    public function debugMode()
    {   
        if (!AccountManager::isSessionActive()) {
            echo "It seems that you are not logged in";
            AccountManager::destroySession();
            return;
        }

        $state = $_REQUEST['value'];

        $debugMode = new debugMode;
        $debugModeResult = $debugMode->toggleDebugMode($state);

        if ($debugModeResult != "") {
            echo $debugModeResult;
            return;
        }

        echo true;
    }

    private function getUpdatesInfo()
    {
        if (!AccountManager::isSessionActive() || !AccountManager::isAdmin()) {
            echo false;
            AccountManager::destroySession();
            return;
        }

        $databaseManager = new DatabaseManager;
        $data = $databaseManager->getUpdatesInfo();
        $data['title'] = "Updates Center";  
        return $data;
    }

}
