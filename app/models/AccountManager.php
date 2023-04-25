<?php
ini_set('session.gc_maxlifetime', 1800); // Session will expire after 30 minutes of inactivity
session_start();
require_once 'connect.php';
require_once 'ErrorsHandler.php';
require_once 'Moderation.php';

class AccountManager
{
    protected const LOGIN_ERROR = "Mail or password incorrect";
    protected const MAIL_EXISTS_ERROR = "Mail already exists";
    protected const PASSWORD_MATCH_ERROR = "Passwords doesn't match";
    protected const GENERAL_ERROR = "Something went wrong on our side, please try again later";
    protected const BANNED_ERROR = "Couldn't log you in :/";
    protected const ACCESS_DENIED_ERROR = "Access denied";
    protected const INCORRECT_TOKEN = "Incorrect Token";
 
    public static function isSessionActive()
    {
        return session_status() === PHP_SESSION_ACTIVE && isset($_SESSION['email']) && isset($_SESSION['name']) && isset($_SESSION['role']);
    }

    protected static function startSession($email)
    {   
        $_SESSION['email'] = $email;
        
        $result = database_query("SELECT `name`, `role`, `debugMode` FROM users WHERE mail = :mail", [':mail' => $email]);
        $_SESSION['name'] = $result['name'];
        $_SESSION['role'] = $result['role'];
        $_SESSION['debugMode'] = $result['debugMode'];

        if (self::isSessionActive()) {
            $_SESSION['loggedIn'] = true;
            return true;
        } 

        self::destroySession();
        return false;
    }

    public static function destroySession()
    {
        session_unset();
        session_destroy();

        if (!self::isSessionActive()) {
            return true;
        }

        return false;
    }
    
    public static function isMailExists($email)
    {
        $result = database_query("SELECT mail FROM users WHERE mail = :mail", [':mail' => $email]);
        if ($result['mail'] == $email) {
            return true;
        } else {
            return false;
        }
    }

    public static function isAdmin()
    {
        return $_SESSION['role'] == 'admin';
    }

    public static function getSessionData()
    {
        if (!self::isSessionActive()) {
            return false;
        }

        return array('email' => $_SESSION['email'], 'name' => $_SESSION['name'], 'role' => $_SESSION['role'], 'debugMode' => $_SESSION['debugMode']);
    }

    public static function getMail()
    {
        if (!self::isSessionActive()) {
            echo self::ACCESS_DENIED_ERROR;
            return false;
        }
        return $_SESSION['email'];
    }
}

class Login extends AccountManager
{   
    public function logUserIn($email, $entered_password)
    {
        if (Moderation::isUserBanned($email))
        {
            echo self::BANNED_ERROR;
            exit();
        }

        if (!(self::isMailExists($email) && $this->isPasswordCorrect($email, $entered_password))) {
            return self::LOGIN_ERROR;
        }

        if (self::startSession($email)) {
            return "";
        }

        return self::GENERAL_ERROR;
    }

    private function isPasswordCorrect($email, $entered_password)
    {
        $result = database_query("SELECT `password` FROM users WHERE mail = :mail", [':mail' => $email]);
        $hashed_password = $result['password'];
        if (password_verify($entered_password, $hashed_password)) {
            return true;
        }

        return false;
    }
}

class Register extends AccountManager
{
    public function registerUser($name, $email, $entered_password, $entered_password_confirm)
    {
        $email = strtolower($email);
        $name = ucfirst($name);

        if (self::isMailExists($email)) {
            return self::MAIL_EXISTS_ERROR;
        } 

        if ($entered_password != $entered_password_confirm) {
            return self::PASSWORD_MATCH_ERROR;
        } 

        $role = $this->getRole($email);
        $this->registerInDatabase($name, $email, $entered_password, $role);

        if (!self::isMailExists($email)) {
            return self::GENERAL_ERROR;
        }
        
        if (self::startSession($email)) {
            self::destroySession();
            return "";
        }
        return self::GENERAL_ERROR;
    }

    private function getRole($email)
    {
        if ($this->isAnAdmin($email)) {
            return "admin";
        }

        foreach ($this->getInsidersList() as $insider) {
            if ($insider['email'] == $email) {
                return "insider";
            }
        }

        if (substr($email, -7) == "isep.fr") {
            return "ISEP";
        }
        
        if (substr($email, -14) == "juniorisep.com") {
            return "JE";
        }

        return "user";
    }

    private function getInsidersList()
    {
        return database_query("SELECT email FROM preco", []);
    }

    private function isAnAdmin($email)
    {
        $adminList = getenv('ADMIN_CREDENTIALS');
        $adminList = explode(',', $adminList);
        foreach ($adminList as $admin) {
            if ($admin == $email) {
                return true;
            }
        }
        return false;
    }

    private function registerInDatabase($name, $email, $entered_password, $role)
    {
        $hashed_password = password_hash($entered_password, PASSWORD_DEFAULT);
        database_query("INSERT INTO users (name, mail, password, role, debugMode) VALUES (:name, :mail, :password, :role, DEFAULT)", [':name' => $name, ':mail' => $email, ':password' => $hashed_password, ':role' => $role]);
        database_query("INSERT INTO moderation (mail, isBanned, tokenNb) VALUES (:mail, DEFAULT, DEFAULT)",[':mail'=> $email]);
    }
}

class debugMode extends AccountManager
{
    public function toggleDebugMode($state)
    {
        if (!self::isSessionActive() || !self::isAdmin($_SESSION['email'])) {
            return self::ACCESS_DENIED_ERROR;
        }

        database_query("UPDATE users SET debugMode = :debugMode WHERE mail = :mail", [':debugMode' => $state, ':mail' => $_SESSION['email']]);
        $_SESSION['debugMode'] = $state;

        if ($this->isDebugModeActive() == $state) {
            return "";
        }

        return self::GENERAL_ERROR;
    }

    public function isDebugModeActive()
    {
        if (!self::isSessionActive() || !self::isAdmin($_SESSION['email'])) {
            return self::ACCESS_DENIED_ERROR;
        }

        $result = database_query("SELECT debugMode FROM users WHERE mail = :mail", [':mail' => $_SESSION['email']]);
        return $result['debugMode'];

    }
}

class Confirmation extends AccountManager
{
    public function createConfirmationCode($email)
    {
        $verifCode = random_int(100000, 999999999);
        database_query("UPDATE users SET verifCode = :verifCode WHERE mail = :mail", [':verifCode' => $verifCode, ':mail' => $email]);
        $this->sendConfirmationMail($email, $verifCode);
    }

    public function confirmAccount($inboundCode, $mail)
    {
        $verifCode = database_query("SELECT verifCode FROM users WHERE mail = :mail", [':mail' => $mail]);
        if ($verifCode['verifCode'] == $inboundCode) {
            database_query("UPDATE users SET verifCode = 1 WHERE mail = :mail", [':mail' => $mail]);
            self::startSession($mail);
            return "";
        }

        return self::INCORRECT_TOKEN;
    }

    public function isAccountConfirmed($mail)
    {
        $verifCode = database_query("SELECT verifCode FROM users WHERE mail = :mail", [':mail' => $mail]);
        if ($verifCode['verifCode'] == 1) {
            return true;
        }
        return false;
    }

    private function sendConfirmationMail($email, $verifCode)
    {
        //TODO : send mail
    } 
}