<?php

class InputValidator
{
    protected const EMPTY_ERROR = "This field is required";
    protected const MIN_LENGTH_ERROR = "At least %d characters are required";
    protected const MAX_LENGTH_ERROR = "Maximum %d characters are allowed";
    protected const INVALID_CARACTERS_ERROR = "Special characters are not allowed";
    protected const INVALID_EMAIL_ERROR = "Invalid email address";
    protected const PASSWORD_WEAK_ERROR = "Password is too weak";

    protected static function isEmpty($input)
    {
        if (empty($input)) {
            return true;
        }
        return false;
    }

    protected static function isTooShort($input, $minLength)
    {
        if (strlen($input) < $minLength) {
            return true;
        }
        return false;
    }

    protected static function isTooLong($input, $maxLength)
    {
        if (strlen($input) > $maxLength) {
            return true;
        }
        return false;
    }
}

class NameInput extends InputValidator
{
    public function validate($input)
    {   
        if (self::isEmpty($input)) {
            return self::EMPTY_ERROR;
        }

        if (self::isTooShort($input, 3)) {
            return sprintf(self::MIN_LENGTH_ERROR, 3);
        }

        if (self::isTooLong($input, 25)) {
            return sprintf(self::MAX_LENGTH_ERROR, 25);
        }

        if (!(preg_match('/^[a-zA-Z -]+$/', $input))) {
            return self::INVALID_CARACTERS_ERROR;
        }
        
        // TODO: Handle forbidden words

        return "";
    }
}

class EmailInput extends InputValidator
{
    public function validate($input)
    {
        if (self::isEmpty($input)) {
            return self::EMPTY_ERROR;
        }

        if (self::isTooLong($input, 50)) {
            return sprintf(self::MAX_LENGTH_ERROR, 50);
        }

        if (!(filter_var($input, FILTER_VALIDATE_EMAIL))) {
            return self::INVALID_EMAIL_ERROR;
        }
        return "";  
    }
}

class PasswordInput extends InputValidator
{
    public function validate($input, $passwordScore)
    {
        if (self::isEmpty($input)) {
            return self::EMPTY_ERROR;
        }

        if (self::isTooShort($input, 8)) {
            return sprintf(self::MIN_LENGTH_ERROR, 8);
        }

        if (self::isTooLong($input, 500)) {
            return sprintf(self::MAX_LENGTH_ERROR, 500);
        }

        if ($passwordScore < 3) {
            return self::PASSWORD_WEAK_ERROR;
        }

        return "";
    }
}

class TextInput extends InputValidator
{
    public function validate($input, $minLength, $maxLength)
    {
        if (self::isEmpty($input)) {
            return self::EMPTY_ERROR;
        }

        if (self::isTooShort($input, $minLength)) {
            return sprintf(self::MIN_LENGTH_ERROR, $minLength);
        }

        if (self::isTooLong($input, $maxLength)) {
            return sprintf(self::MAX_LENGTH_ERROR, $maxLength);
        }

        if (preg_match('/[<>"&%\\\\]/', $input)) {
            return self::INVALID_CARACTERS_ERROR;
        }

        return "";
    }

}

class SerialNumberInput extends InputValidator
{
    public function validate($input)
    {
        if (self::isEmpty($input)) {
            return self::EMPTY_ERROR;
        }

        if (self::isTooShort($input, 8)) {
            return sprintf(self::MIN_LENGTH_ERROR, 8);
        }

        if (self::isTooLong($input, 10)) {
            return sprintf(self::MAX_LENGTH_ERROR, 10);
        }

        if (!(preg_match('/^[a-zA-Z0-9 -]+$/', $input))) {
            return self::INVALID_CARACTERS_ERROR;
        }

        return "";
    }
}
