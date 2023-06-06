<?php

use Google\Service\Appengine\ErrorHandler;

require_once($_SERVER['DOCUMENT_ROOT'] . '/app/models/InputValidator.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/app/models/AccountManager.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/app/models/DeviceManager.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/app/models/ErrorsHandler.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/app/models/QAManager.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/app/models/Moderation.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/app/models/SearchEngine.php');

class account extends Controller
{

    public function index()
    {
        $this->header();
        $this->account();
    }

    public function googleAuth()
    {
        $tokenID = $_POST['credential'] ?? null;

        if ($tokenID == null) {
            ErrorsHandler::newError("Google auth : no credentials received" . $_SERVER['PHP_SELF'], 1, false);
            header("Location: /account/login");
            exit();
        }

        $tokenParts = explode(".", $tokenID);
        $tokenPayload = base64_decode($tokenParts[1]);
        $payload = json_decode($tokenPayload, true);

        $GoolgeAuth = new GoogleAuth;
        if (!$GoolgeAuth->isPayloadValid($payload)) {
            echo "<script>alert('Something went wrong while connecting with Google');</script>";
            header("Location: /account/login");
            exit();
        }

        $result = $GoolgeAuth->setSession($payload['name'], $payload['email'], $payload['email_verified']);
        if (!$result) {
            ErrorsHandler::newError("Google auth : Something went wrong while sign in the user", 1, false);
        }

        if (AccountManager::isAdmin()) {
            header("Location: /account/admin");
        } else {
            header("Location: /account/user");
        }
    }

    public function isLogedIn()
    {
        if (AccountManager::isSessionActive()) {
            echo true;
        } else {
            echo false;
        }
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
        $this->footer();
    }

    public function admin($args = [])
    {
        // Redirect to login if not admin
        if (!AccountManager::isAdmin()) {
            ErrorsHandler::newError('User ' . AccountManager::getMail() . ' tried to access admin panel', 1, false);
            Moderation::flagUser(AccountManager::getMail());
            AccountManager::destroySession();
            $this->account();
            return;
        }

        $data = AccountManager::getSessionData();
        $this->account($data, "admin");

        if ($args == 'updates') {
            $data2 = $this->getUpdatesInfo();
            $this->view('account/admin/updates', $data2);
            return;
        }

        if ($args == 'faq') {
            $QAManager = new QAManager;
            $data2 = $QAManager->getFAQ();
            $this->view('account/admin/faq', $data2);
        }
        $this->footer();
    }

    public function logUserIn()
    {
        $email = trim($_REQUEST['email']);
        $password = trim($_REQUEST['password']);

        $emailInput = new EmailInput;
        $emailResult = $emailInput->validate($email);
        $passwordInput = new PasswordInput;
        $passwordResult = $passwordInput->validate($password);

        if ($emailResult || $passwordResult) {
            echo json_encode(array('result' => 'InputsError', 'emailErrorMessage' => $emailResult, 'passwordErrorMessage' => $passwordResult));
            return;
        }

        $login = new Login;
        $loginResult = $login->logUserIn($email, $password);

        if ($loginResult != "") {
            echo json_encode(array('result' => 'LoginError', 'emailErrorMessage' => $loginResult, 'passwordErrorMessage' => ""));
            return;
        }

        $confirmation = new Confirmation;
        $confirmationResult = $confirmation->isAccountConfirmed($email);

        if ($confirmationResult != 1 && $confirmationResult != 2) {
            echo json_encode(array('result' => 'ConfirmationError', 'emailErrorMessage' => "Please confirm your account first", 'passwordErrorMessage' => ""));
            return;
        }

        Moderation::unflagUser($email);
        echo true;
    }

    public function logUserOut()
    {
        if (AccountManager::destroySession() == true) {
            echo true;
            return;
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
            return;
        }

        if (Moderation::isUserBanned($email)) {
            echo ("Something went wrong :/, please contact us");
            return;
        } else {
            Moderation::flagUser($email);
        }

        $register = new Register;
        $registerResult = $register->registerUser($name, $email, $password, $passwordConfirm);

        if ($registerResult != "") {
            echo json_encode(array('result' => 'RegisterError', 'emailErrorMessage' => $registerResult, 'passwordErrorMessage' => "", 'nameErrorMessage' => "", 'passwordConfirmErrorMessage' => ""));
            return;
        }

        $confirmation = new Confirmation;
        $token = $confirmation->createConfirmationCode($email);
        $confirmation->sendConfirmationMail($email, $token);

        echo true;
    }

    public function confirmAccount()
    {
        $email = $_GET['mail'];
        $token = $_GET['token'];

        if ($token == '""' || empty($token) || $email == '""' || empty($email)) {
            echo "Invalid Query";
            exit();
        }

        if (!AccountManager::isMailExists($email)) {
            echo "Invalid Query*";
            exit();
        }

        if (Moderation::isUserBanned($email)) {
            echo "Something went wrong";
            exit();
        }

        Moderation::flagUser($email);

        $confirmation = new Confirmation;
        $token = preg_replace("/[^0-9]/", "", $token);
        $confirmation->confirmAccount($token, $email);

        if ($token != "0000") {
            header("Location: confirmAccount?mail=" . $email . "&token=0000");
        }

        if ($confirmation->isAccountConfirmed($email)) {
            $this->header();
            $this->view('account/verified');
            $this->footer();
            Moderation::unflagUser($email);
        } else {
            echo "Impossible to verify your account :/";
        }
    }

    public function changePassword()
    {
        $this->header();
        $this->view('account/password-recovery');
        $this->footer();
    }

    public function changeEmail()
    {
    }

    public function changeName()
    {
    }

    public function getNewPassword()
    {
        $email = $_REQUEST['email'];

        $emailInput = new EmailInput;
        $emailResult = $emailInput->validate($email);

        if ($emailResult != "") {
            echo "Invalid email";
            return;
        }

        if (!AccountManager::isMailExists($email)) {
            return 'true';
        }

        $password = Password::generateNew($email);
        $confirmation = new Confirmation;
        $result = $confirmation->sendNewPassword($email, $password);
        
        if ($result == "" || $result == true) {
            echo 'true';
            return;
        }
        
        echo 'false';
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
        if (!AccountManager::isSessionActive() || !AccountManager::isAdmin()) {
            echo "Something went wrong";
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

    public function updateFAQ()
    {
        if (!AccountManager::isSessionActive() || !AccountManager::isAdmin()) {
            echo false;
            AccountManager::destroySession();
            return;
        }

        $data = json_decode(file_get_contents('php://input'));

        $QAManager = new QAManager;
        $QAManager->updateFAQ($data);

        echo "Q&A updated successfully";
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

    public function superSearch()
    {
        if (AccountManager::isSessionActive() && !(AccountManager::isAdmin())) {
            ErrorsHandler::newError("Unauthorized access to superSearch", 1, false);
            Moderation::flagUser(AccountManager::getMail());
            AccountManager::destroySession();
            exit();
        }

        $params = $_GET['params'];
        $searchEngine = new SearchEngine;
        $result = $searchEngine->search($params);

        echo json_encode($result);
    }
}
