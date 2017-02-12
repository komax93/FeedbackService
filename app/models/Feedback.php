<?php

class Feedback
{
    public static function getSortedFeedbackBy($orderBy = null)
    {
        $db = Database::getConnection();
        $orderBy = self::getOrder($orderBy);
        
        try
        {
            $sql = "SELECT login, email, text, feed_date FROM feed ORDER BY {$orderBy} DESC";
            $feed = $db->query($sql);
            
            $i = 0;
            $feedbackList = array();

            while($row = $feed->fetch())
            {
                $feedbackList[$i]['login'] = $row['login'];
                $feedbackList[$i]['email'] = $row['email'];
                $feedbackList[$i]['text'] = $row['text'];
                $feedbackList[$i]['feed_date'] = date('d-m-Y H:i:s', $row['feed_date']);
                $i++;
            }
            
            return $feedbackList;
        }
        catch (PDOException $e)
        {
            return;
        }
    }

    public static function saveFeed($login, $email, $text)
    {
        $db = Database::getConnection();
        $currentDate = time();

        try
        {
            $sql = "INSERT INTO feed (login, email, text, feed_date) VALUES(:login, :email, :text, :feed_date)";
            $feed = $db->prepare($sql);

            $feed->bindParam(':login', $login, PDO::PARAM_STR);
            $feed->bindParam(':email', $email, PDO::PARAM_STR);
            $feed->bindParam(':text', $text, PDO::PARAM_STR);
            $feed->bindParam(':feed_date', $currentDate, PDO::PARAM_INT);

            $feed->execute();

        }
        catch (PDOException $e)
        {
            return;
        }
    }

    private static function getOrder($orderBy)
    {
        if($orderBy == 'login')
        {
            return 'login, feed_date';
        }
        else if($orderBy == 'email')
        {
            return 'email, feed_date';
        }
        else
        {
            return 'feed_date';
        }
    }
    
    public static function checkParameters($login, $email, $text)
    {
        if((strlen($login) < 3) || (filter_var($email, FILTER_VALIDATE_EMAIL) === false) || (strlen($text) < 3))
        {
            return false;
        }
        
        return true;
    }
}