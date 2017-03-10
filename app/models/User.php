<?php

class User
{
    public static function getUserData($user)
    {
        if(!empty($user))
        {
            $db = Database::getConnection();
            $password = md5($user['password']);

            try
            {
                $sql = "SELECT * FROM admins WHERE (login = :loginOrEmail OR email = :loginOrEmail) AND password = :password";
                $result = $db->prepare($sql);
                $result->bindParam(':loginOrEmail', $user['login'], PDO::PARAM_STR);
                $result->bindParam(':loginOrEmail', $user['login'], PDO::PARAM_STR);
                $result->bindParam(':password', $password, PDO::PARAM_STR);
                $result->execute();

                $user = $result->fetch(PDO::FETCH_ASSOC);

                if($user)
                {
                    return [
                        'id' => $user['id'],
                        'login' => $user['login'],
                        'email' => $user['email'],
                        'privileges' => $user['privileges']
                    ];
                }
            }
            catch(PDOException $e)
            {
                die("Query in User::getUserData() is wrong: {$e->getMessage()}");
            }
        }

        return false;
    }

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

    public static function auth($user)
    {
        $_SESSION['user'] = $user;
    }

    public static function isAuthorised()
    {
        if(isset($_SESSION['user']))
        {
            return true;
        }

        return false;
    }

    public static function isAdmin()
    {
        if(isset($_SESSION['user']))
        {
            if(intval($_SESSION['user']['privileges']))
            {
                return true;
            }
        }

        return false;
    }
}