<?php

class Check
{
    public static function checkParameters($login, $email, $text, $isUpload)
    {
        if((strlen($login) < 3) || (filter_var($email, FILTER_VALIDATE_EMAIL) === false)
            || (strlen($text) < 3) || ($isUpload === false))
        {
            return false;
        }

        return true;
    }
}