<?php

class UserController
{
    public function actionLogin()
    {
        if(User::isAuthorised())
        {
            header("Location: /");
        }

        if(isset($_POST['submit']))
        {
            $login = filter_var($_POST['login'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $password = filter_var($_POST['password'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            $errors = false;

            if(!Check::checkLogin($login))
            {
                $errors[] = "Incorrect login. Less than 2 symbols";
            }
            if(!Check::checkPassword($password))
            {
                $errors[] = "Incorrect password. Less than 6 symbols";
            }

            if($errors === false)
            {
                $user = [
                    'login' => $login,
                    'password' => $password
                ];


                if(($userInfo = User::getUserData($user)) !== false)
                {
                    User::auth($userInfo);
                    header("Location: /");
                }
                else
                {
                    $errors[] = "Wrong login or email!";
                }
            }
        }

        require_once (APP_PATH . 'views/user/login.php');
        return true;
    }

    public function actionRegister()
    {
        if(User::isAuthorised())
        {
            header("Location: /");
        }

        if(isset($_POST['submit']))
        {
            $login = filter_var($_POST['login'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $email = filter_var($_POST['email'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $password = filter_var($_POST['password'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            $errors = false;

            if(!Check::checkLogin($login))
            {
                $errors[] = "Incorrect login. Less than 2 symbols";
            }
            if(!Check::checkEmail($email))
            {
                $errors[] = "Incorrect email format.";
            }
            if(!Check::checkPassword($password))
            {
                $errors[] = "Incorrect password. Less than 6 symbols";
            }

            if($errors === false)
            {
                $user = [
                    'login' => $login,
                    'email' => $email,
                    'password' => $password
                ];

                if(!User::isUserExists($user))
                {
                    User::register($user);
                    User::auth($user);
                    header("Location: /");
                }
                else
                {
                    $errors[] = "User is exists";
                }
            }
        }

        require_once (APP_PATH . 'views/user/register.php');
        return true;
    }

    public function actionLogout()
    {
        if(User::isAuthorised())
        {
            $_SESSION = [];
            unset($_COOKIE[session_name()]);
            session_destroy();
        }

        header("Location: /");
        return true;
    }
}