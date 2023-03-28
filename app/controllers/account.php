<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/app/models/userSession.php');

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
        $data = getSessionData();
        if (hasADevice()) {
            $deviceData = getDeviceData();
            $data['device id'] = $deviceData['device id'];
            $data['added date'] = $deviceData['added date'];
            $data['device connected'] = $deviceData['device connected'];
            $data['hasDevice'] = true;
        } else {
            $data['hasDevice'] = false;
        }

        $this->account($data);
    }


    public function admin()
    {   
        $data = getSessionData();
        $this->account($data);
    }

    public function logUserIn()
    {
        $email = $_REQUEST['email'];
        $password = $_REQUEST['password'];
        $stayConnected = $_REQUEST['stayConnected'];

        $emailErrorMessage = $this->checkEmail($email);
        $passwordErrorMessage = $this->checkInput($password);

        if ($emailErrorMessage != "" || $passwordErrorMessage != "") {
            echo json_encode(array(
                'emailErrorMessage' => $emailErrorMessage,
                'passwordErrorMessage' => $passwordErrorMessage
            ));
            return;
        }

        require_once($_SERVER['DOCUMENT_ROOT'] . '/app/models/login.php');
        if (!isEmailExist($email) || !isPasswordCorrect($email, $password)) {
            echo json_encode(array(
                'emailErrorMessage' => "Mail or password incorrect",
                'passwordErrorMessage' => ""
            ));
            return;
        }

        createSession($email);

        if (isSessionActive() && isSessionDataExist()) {
            echo true;
        }

        echo false;
    }

    public function logUserOut()
    {
        destroySession();
        if (!isSessionActive() && !isSessionDataExist()) {
            echo true;
            return;
        }

        echo false;
    }

    public function registerUser()
    {
        $name = $_REQUEST['name'];
        $email = $_REQUEST['email'];
        $password = $_REQUEST['password'];
        $passwordConfirm = $_REQUEST['passwordConfirmation'];
        $zxcvbnSS = $_REQUEST['zxcvbnSS'];

        $emailErrorMessage = $this->checkEmail($email);
        $nameErrorMessage = $this->checkName($name);
        $passwordErrorMessage = $this->checkPasswordCreation($zxcvbnSS, $password);
        $passwordConfirmErrorMessage = $this->checkPasswordsMatch($password, $passwordConfirm);

        if ($emailErrorMessage != "" || $passwordErrorMessage != "" || $nameErrorMessage != "" || $passwordConfirmErrorMessage != "") {
            echo json_encode(array(
                'emailErrorMessage' => $emailErrorMessage,
                'passwordErrorMessage' => $passwordErrorMessage,
                'nameErrorMessage' => $nameErrorMessage,
                'passwordConfirmErrorMessage' => $passwordConfirmErrorMessage
            ));
            return;
        }

        require_once($_SERVER['DOCUMENT_ROOT'] . '/app/models/register.php');
        if (isEmailExist($email)) {
            echo json_encode(array(
                'emailErrorMessage' => 'This email is already used',
                'passwordErrorMessage' => '',
                'nameErrorMessage' => '',
                'passwordConfirmErrorMessage' => ''
            ));
            return;
        }

        $password = password_hash($password, PASSWORD_DEFAULT);
        $role = $this->getRole($email);
        registerUser($name, $email, $password, $role);

        if (!isEmailExist($email)) {
            echo json_encode(array(
                'emailErrorMessage' => 'An error occured',
                'passwordErrorMessage' => '',
                'nameErrorMessage' => '',
                'passwordConfirmErrorMessage' => ''
            ));
            return;
        }

        createSession($email);
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

    public function getNewPassword(){
        if (!isSessionActive()){
            echo 'You are not logged in';
            return;
        }

        echo 'function not supported yet :/';

    }

    public function registerDevice()
    {
        $serialNumber = $_REQUEST['serial'];
        $purshaseDate = $_REQUEST['date'];
        
        if (hasADevice()) {
            echo json_encode(array(
                'serialNumberErrorMessage' => 'A device already exist'
            ));
            return;
        }
        
        if (!isSessionActive()){
            echo json_encode(array(
                'serialNumberErrorMessage' => 'User not logged in'
            ));
            return;
        }
        
        $serialNumberErrorMessage = $this->checkInput($serialNumber);
        if ($serialNumberErrorMessage != "") {
            echo json_encode(array(
                'serialNumberErrorMessage' => $serialNumberErrorMessage
            ));
            return;
        }
        
        addDevice($serialNumber, $purshaseDate);
        if (hasADevice()) {
            echo true;
            return;
        }

        echo json_encode(array(
            'serialNumberErrorMessage' => 'The device could not be added'
        ));
        
    }

    public function deleteDevice()
    {
        if (!isSessionActive()){
            echo json_encode(array(
                'serialNumberErrorMessage' => 'User not logged in'
            ));
            return;
        } 

        if (!hasADevice()) {
            echo json_encode(array(
                'serialNumberErrorMessage' => 'No device to delete'
            ));
            return;
        }
        
        removeDevice();

        if (!hasADevice()) {
            echo true;
            return;
        }

        echo json_encode(array(
            'serialNumberErrorMessage' => 'The device could not be deleted'
        ));
    }

    private function checkInput($input)
    {
        $inputNoWhiteSpace = preg_replace('/\s+/', '', $input);

        if ($inputNoWhiteSpace == "") {
            return "This field can't be empty";
        }

        // Security layer
        require_once($_SERVER['DOCUMENT_ROOT'] . '/app/protected-computing/private-compute-core.php');
        $IFSresult = IFS($email);
        if ($IFSresult != "") {
            return $IFSresult;
        }

        return "";
    }

    private function checkEmail($email)
    {
        $result = $this->checkInput($email);
        if ($result != "") {
            return $result;
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($email) < 10 || strlen($email) > 50) {
            return "This email is not valid";
        }
    }

    private function checkName($name)
    {
        // Check if name is not too short
        if (strlen($name) < 3) {
            return "The name is too short";
        }

        // Check if name contains only letters, whitespaces, dashes and apostrophes
        if (!preg_match("/^[a-zA-ZÀ-ÖØ-öø-ÿ\s'-]+$/", $name)) {
            return "Your name cannot contain special characters";
        }

        /*require_once($_SERVER['DOCUMENT_ROOT'] . '/app/protected-computing/private-compute-core.php');
        if (INF($name)) {
            return "Incorrect name";
        }
        */

        return "";
    }

    private function checkPasswordCreation($passwordScore, $password)
    {
        // Check if the password score is not too low
        if ($passwordScore < 3) {
            return "The password is too weak";
        }

        if (strlen($password) > 100) {
            return "Okay dude, calm down on your password";
        }

        return "";
    }

    private function checkPasswordsMatch($password, $passwordConfirmation)
    {
        $result = $this->checkInput($password);
        if ($result != "") {
            return $result;
        }

        $result = $this->checkInput($passwordConfirmation);
        if ($result != "") {
            return $result;
        }

        // Check if the passwords match
        if ($password != $passwordConfirmation) {
            return "Passwords doesn't match";
        }

        return "";
    }

    private function getRole($email)
    {
        $email = strtolower($email);

        // Check if the user is an admin
        if (isAnAdmin($email)){
            return "Admin";
        }

        // Check if the user is an insider
        require_once($_SERVER['DOCUMENT_ROOT'] . '/app/models/insiders.php');
        foreach (getInsidersList() as $insider) {
            if ($insider['email'] == $email) {
                return "Insider";
            }
        }

        // Check if the user is an ISEP student
        if (substr($email, -7) == "isep.fr") {
            return "ISEP";
        }

        return "User";
    }
}
