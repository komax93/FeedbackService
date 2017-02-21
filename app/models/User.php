<?php

class User
{
    public static function register($login, $email, $password)
    {
        $db = Database::getConnection();
        $password = md5($password);
        try
        {
            $sql = "INSERT INTO admins (login, password, email) VALUES(:login, :password, :email)";
            $result = $db->prepare($sql);
            $result->bindParam(':login', $login, PDO::PARAM_STR);
            $result->bindParam(':password', $password, PDO::PARAM_STR);
            $result->bindParam(':email', $email, PDO::PARAM_STR);

            $result->execute();
        }
        catch (PDOException $e)
        {
            return;
        }
    }

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