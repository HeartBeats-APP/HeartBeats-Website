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
        $this->account($data, "admin");
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
        if (isEmailExist($email) && isPasswordCorrect($email, $password)) {
            createSession($email);
            if (isSessionActive() && isSessionDataExist()) {
                echo true;
                return;
            }
            newErrorMessage("Impossible to log in the following user despite correct credentials: " . $email);
        }

        echo json_encode(array(
            'emailErrorMessage' => "Mail or password incorrect",
            'passwordErrorMessage' => ""
        ));
    }

    public function logUserOut()
    {
        destroySession();
        if (!isSessionActive() && !isSessionDataExist()) {
            echo true;
            return;
        }

        newErrorMessage("Impossible to log out the following user: " . getMail());
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
        if (isEmailExist($email)) {
            echo true;
            createSession($email);
            return;
        }

        newErrorMessage("Impossible to register the following user: $email");
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
        if (!isSessionActive()) {
            echo 'You are not logged in';
            destroySession();
            newErrorMessage("User tried to get a new password while he was not logged in");
            return;
        }

        echo 'function not supported yet :/';
    }

    public function registerDevice()
    {
        $serialNumber = $_REQUEST['serial'];
        $purshaseDate = $_REQUEST['date'];

        if (hasADevice()) {
            newErrorMessage("User " . getMail() . " tried to add a device while he already has one");
            return;
        }

        if (!isSessionActive()) {
            echo "It seems that you are not logged in";
            destroySession();
            return;
        }

        $serialNumberErrorMessage = $this->checkInput($serialNumber);
        if ($serialNumberErrorMessage != "") {
            echo $serialNumberErrorMessage;
            return;
        }

        addDevice($serialNumber, $purshaseDate);
        if (hasADevice()) {
            echo true;
            return;
        }

        newErrorMessage("Failed to add the device of the following user: " . getMail());
    }

    public function deleteDevice()
    {
        if (!isSessionActive()) {
            echo json_encode(array(
                'errorMessage' => 'It seems that you are not logged in'
            ));
            destroySession();
            return;
        }

        if (!hasADevice()) {
            newErrorMessage("User " . getMail() . " tried to delete a device while he doesn't have one");
            return;
        }

        removeDevice();

        if (!hasADevice()) {
            echo true;
            return;
        }

        newErrorMessage("Impossible to delete the device of the following user: " . getMail());
    }

    public function debugMode()
    {
        if (!isSessionActive() || getRole() != 'admin') {
            echo 'Something went wrong';
            newWarningMessage("The non-admin user " . getMail() . " tried to enable the debug mode");
            return;
        }
        $value = $_REQUEST['value'];

        debugMode($value);

        if (isDebugMode() == $value) {
            echo true;
            return;
        }

        newErrorMessage("Impossible to change the debug mode state for the following admin: " . getMail());
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

        $forbiddenNames = array(base64_decode('YWRtaW4='), base64_decode('cm9vdA=='), base64_decode('YWRtaW5pc3RyYXRvcg=='), base64_decode('bW9kZXJhdG9y'), base64_decode('bW9k'), base64_decode('bW9kZXJhdGV1cg=='), base64_decode('ZmRw'), base64_decode('Y29ubmFyZA=='), base64_decode('Y29u'), base64_decode('Y29ubmFzc2U='), base64_decode('cHV0ZQ=='), base64_decode('c2Fsb3Bl'), base64_decode('YWRtaW5pc3RyYXRldXI='), base64_decode('YWRtaW5pc3RyYXRyaWNl'), base64_decode('bWFyaWUtc29saW5l'), base64_decode('bWFyaWUgc29saW5l'), base64_decode('bWFyaWUgc29saW4='), base64_decode('bWFyaWUtc29saW4='), base64_decode('c3VwZXJhZG1pbg=='), base64_decode('c3VwZXItYWRtaW4='), base64_decode('c3VwZXIgYWRtaW4='), base64_decode('c3VwZXItYWRtaW5pc3RyYXRvcg=='), base64_decode('c3VwZXIgYWRtaW5pc3RyYXRvcg=='), base64_decode('c3VwZXItYWRtaW5pc3RyYXRldXI='), base64_decode('c3VwZXIgYWRtaW5pc3RyYXRldXI='), base64_decode('c3VwZXItYWRtaW5pc3RyYXRyaWNl'), base64_decode('c3VwZXIgYWRtaW5pc3RyYXRyaWNl'), base64_decode('c3VwZXItbW9k'), base64_decode('c3VwZXIgbW9k'), base64_decode('c3VwZXItbW9kZXJhdG9y'), base64_decode('c3VwZXIgbW9kZXJhdG9y'), base64_decode('c3VwZXItbW9kZXJhdGV1cg=='), base64_decode('c3VwZXIgbW9kZXJhdGV1cg=='), base64_decode('c3VwZXItbW9kZXJhdHJpY2U='), base64_decode('c3VwZXIgbW9kZXJhdHJpY2U='), base64_decode('c3VwZXItbW9kw6lyYXRldXI='), base64_decode('c3VwZXIgbW9kw6lyYXRldXI='), base64_decode('c3VwZXItbW9kw6lyYXRyaWNl'), base64_decode('c3VwZXIgbW9kw6lyYXRyaWNl'), base64_decode('c3VwZXItbW9kw6lyYXRldXI='), base64_decode('c3VwZXIgbW9kw6lyYXRldXI='), base64_decode('c3Vw'), base64_decode('bW9kZXJhdGV1cg=='), base64_decode('bW9k'));
        $name = strtolower($name);
        if (in_array($name, $forbiddenNames)) {
            return "This name is not allowed";
        }

        return "";
    }

    private function checkPasswordCreation($passwordScore, $password)
    {
        // Check if the password score is not too low
        if ($passwordScore < 3) {
            return "The password is too weak";
        }

        if (strlen($password) >= 500) {
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
        if (isAnAdmin($email)) {
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
