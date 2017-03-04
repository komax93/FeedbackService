<?php

class Check
{
    public static function checkParameters($login, $email, $text)
    {
        if((strlen($login) < 3) || (filter_var($email, FILTER_VALIDATE_EMAIL) === false)
            || (strlen($text) < 3))
        {
            return false;
        }

        return true;
    }

    public static function checkLogin($login)
    {
        if(strlen($login) > 2)
        {
            return true;
        }

        return false;
    }

    public static function checkEmail($email)
    {
        if(filter_var($email, FILTER_VALIDATE_EMAIL))
        {
            return true;
        }

        return false;
    }

    public static function checkPassword($password)
    {
        if(strlen($password) >= 6)
        {
            return true;
        }

        return false;
    }
    
    public static function checkText($text)
    {
        if(strlen($text) > 3)
        {
            return true;
        }

        return false;
    }

    public static function checkImage($isUpload)
    {
        if($isUpload !== false)
        {
            return true;
        }

        return false;
    }
}