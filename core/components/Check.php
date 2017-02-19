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
    
    public static function checkImage($isUpload)
    {
        if($isUpload === false)
        {
            return false;
        }
        
        return true;
    }
}