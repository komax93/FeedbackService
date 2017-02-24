<?php

class User
{
    public static function register($user)
    {
        if(!empty($user))
        {
            $db = Database::getConnection();
            $password = md5($user['password']);

            try
            {
                $sql = "INSERT INTO admins (login, password, email) VALUES(:login, :password, :email)";
                $result = $db->prepare($sql);
                $result->bindParam(':login', $user['login'], PDO::PARAM_STR);
                $result->bindParam(':password', $password, PDO::PARAM_STR);
                $result->bindParam(':email', $user['email'], PDO::PARAM_STR);

                $result->execute();
            }
            catch (PDOException $e)
            {
                die("Query in User::register() is wrong: {$e->getMessage()}");
            }
        }
    }

    public static function isUserExists($user)
    {
        if(!empty($user))
        {
            $db = Database::getConnection();

            try
            {
                $sql = "SELECT count(*) FROM admins WHERE login = :login OR email = :email";
                $result = $db->prepare($sql);
                $result->bindParam(':login', $user['login'], PDO::PARAM_STR);
                $result->bindParam(':email', $user['email'], PDO::PARAM_STR);
                $result->execute();

                if($result->fetchColumn())
                {
                    return true;
                }
            }
            catch (PDOException $e)
            {
                die("Query in User::isUserExists() is wrong: {$e->getMessage()}");
            }
        }

        return false;
    }
}