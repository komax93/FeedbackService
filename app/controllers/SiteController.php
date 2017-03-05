<?php

class SiteController
{
    public function actionIndex()
    {
        $order = isset($_GET['order']) ? filter_var($_GET['order'], FILTER_SANITIZE_FULL_SPECIAL_CHARS) : null;
        $feedbackList = Feedback::getSortedFeedbackBy($order);

        $smarty = Viewer::getInstance();
        $smarty->assign("feedback", $feedbackList);
        $smarty->display("index.tpl");

        return true;
    }

    public function actionSave()
    {
        if(isset($_POST['submit']))
        {
            $login = filter_var($_POST['login'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $email = filter_var($_POST['email'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $text = filter_var($_POST['text'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $imageFile = (!empty($_FILES['file']['tmp_name'])) ? $_FILES['file'] : null;

            $errors = false;

            if(!Check::checkLogin($login))
            {
                $errors[] = "Incorrect login. Less than 2 symbols.";
            }
            if(!Check::checkEmail($email))
            {
                $errors[] = "Incorrect email format.";
            }
            if(!Check::checkText($text))
            {
                $errors[] = "Text is too short. Less than 3 symbols.";
            }

            if($errors === false)
            {
                $imgResult = Image::save($imageFile);

                if(!Check::checkImage($imgResult))
                {
                    $errors[] = "Error loading image.";
                }
                else
                {
                    Feedback::saveFeed($login, $email, $text, $imgResult);
                }
            }
        }

        header('Location: /');
        return true;
    }
}