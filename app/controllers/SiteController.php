<?php

class SiteController
{
    public function actionIndex()
    {
        $order = isset($_GET['order']) ? filter_var($_GET['order'], FILTER_SANITIZE_FULL_SPECIAL_CHARS) : '';
        $feedbackList = Feedback::getSortedFeedbackBy($order);

        require_once (ROOT . 'app/views/site/index.php');
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

            $imgResult = Image::save($imageFile);
            $result = Check::checkParameters($login, $email, $text, $imgResult);
            
            if($result !== false)
            {
                Feedback::saveFeed($login, $email, $text, $imgResult);
            }
        }

        header('Location: /');
        return true;
    }
}