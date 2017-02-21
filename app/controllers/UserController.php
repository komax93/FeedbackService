<?php

class UserController
{
    public function actionLogin()
    {


        require_once (ROOT . 'app/views/user/login.php');
        return true;
    }

    public function actionRegister()
    {
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
                User::register($login, $email, $password);
            }
        }

        require_once (ROOT . 'app/views/user/register.php');
        return true;
    }

    public function actionLogout()
    {
        echo "logout";
        return true;
    }
}