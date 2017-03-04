<?php

class Feedback
{
    public static function getSortedFeedbackBy($orderBy = null)
    {
        $db = Database::getConnection();
        $orderBy = self::getOrder($orderBy);
        
        try
        {
            $sql = "SELECT login, email, text, feed_date, image_path FROM feed ORDER BY {$orderBy} DESC";
            $feed = $db->query($sql);
            
            $i = 0;
            $feedbackList = array();

            while($row = $feed->fetch())
            {
                $feedbackList[$i]['login'] = $row['login'];
                $feedbackList[$i]['email'] = $row['email'];
                $feedbackList[$i]['text'] = $row['text'];
                $feedbackList[$i]['feed_date'] = date('d-m-Y H:i:s', $row['feed_date']);
                $feedbackList[$i]['image_path'] = $row['image_path'];
                $i++;
            }
            
            return $feedbackList;
        }
        catch (PDOException $e)
        {
            die("Query in Feedback::getSortedFeedbackBy() is wrong: {$e->getMessage()}");
        }
    }

    public static function saveFeed($login, $email, $text, $imgResult)
    {
        $db = Database::getConnection();
        $currentDate = time();

        try
        {
            $sql = "INSERT INTO feed (login, email, text, feed_date, image_path) 
                    VALUES(:login, :email, :text, :feed_date, :image_path)";
            $feed = $db->prepare($sql);

            $feed->bindParam(':login', $login, PDO::PARAM_STR);
            $feed->bindParam(':email', $email, PDO::PARAM_STR);
            $feed->bindParam(':text', $text, PDO::PARAM_STR);
            $feed->bindParam(':feed_date', $currentDate, PDO::PARAM_INT);
            $feed->bindParam(':image_path', $imgResult, PDO::PARAM_STR);

            $feed->execute();

        }
        catch (PDOException $e)
        {
            die("Query in Feedback::saveFeed() is wrong: {$e->getMessage()}");
        }
    }

    private static function getOrder($orderBy)
    {
        switch ($orderBy)
        {
            case 'login':
                return 'login, feed_date';
            case 'email':
                return 'email, feed_date';
            default:
                return 'feed_date';
        }
    }
}