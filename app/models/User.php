<?php

class User
{
    public static function isEmailExists($email)
    {
        $db = Database::getConnection();

        $sql = "SELECT count(*) FROM users WHERE email = :email";
        $result = $db->prepare($sql);
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->execute();

        if($result->fetchColumn())
        {
            return true;
        }

        return false;
    }
}