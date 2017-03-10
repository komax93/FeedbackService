<?php

class Feedback
{
    public static function getSortedFeedbackBy($orderBy = null)
    {
        $db = Database::getConnection();
        $orderBy = self::getOrder($orderBy);
        
        try
        {
            $sql = "SELECT * FROM feed ORDER BY {$orderBy} DESC";
            $feed = $db->query($sql);
            
            $i = 0;
            $feedbackList = array();

            while($row = $feed->fetch())
            {
                $feedbackList[$i]['id'] = $row['id'];
                $feedbackList[$i]['login'] = $row['login'];
                $feedbackList[$i]['email'] = $row['email'];
                $feedbackList[$i]['text'] = $row['text'];
                $feedbackList[$i]['feed_date'] = date('d-m-Y H:i:s', $row['feed_date']);
                $feedbackList[$i]['is_changed'] = $row['is_changed'];
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

    public static function getFeedbackById($id)
    {
        $db = Database::getConnection();

        try
        {
            $sql = "SELECT * FROM feed WHERE id = :id";
            $result = $db->prepare($sql);

            $result->bindParam(':id', $id);
            $result->execute();

            $feedback = $result->fetch(PDO::FETCH_ASSOC);

            return $feedback;
        }
        catch (PDOException $e)
        {
            die("Query in Feedback::getFeedbackById() is wrong: {$e->getMessage()}");
        }
    }

    public static function saveFeedback($feedback)
    {
        $db = Database::getConnection();
        $currentDate = time();

        try
        {
            $sql = "INSERT INTO feed (login, email, text, feed_date, image_path) 
                    VALUES(:login, :email, :text, :feed_date, :image_path)";
            $feed = $db->prepare($sql);

            $feed->bindParam(':login', $feedback['login'], PDO::PARAM_STR);
            $feed->bindParam(':email', $feedback['email'], PDO::PARAM_STR);
            $feed->bindParam(':text', $feedback['text'], PDO::PARAM_STR);
            $feed->bindParam(':feed_date', $currentDate, PDO::PARAM_INT);
            $feed->bindParam(':image_path', $feedback['image_path'], PDO::PARAM_STR);
            $feed->execute();
        }
        catch (PDOException $e)
        {
            die("Query in Feedback::saveFeedback() is wrong: {$e->getMessage()}");
        }
    }

    public static function updateFeedback($feedback)
    {
        $db = Database::getConnection();
        $currentDate = time();

        try
        {
            $sql = "UPDATE feed 
                    SET login = :login, email = :email, text = :text, feed_date = :feed_date, is_changed = 1
                    WHERE id = :id";
            $feed = $db->prepare($sql);

            $feed->bindParam(':id', $feedback['id'], PDO::PARAM_INT);
            $feed->bindParam(':login', $feedback['login'], PDO::PARAM_STR);
            $feed->bindParam(':email', $feedback['email'], PDO::PARAM_STR);
            $feed->bindParam(':text', $feedback['text'], PDO::PARAM_STR);
            $feed->bindParam(':feed_date', $currentDate, PDO::PARAM_INT);
            $feed->execute();
        }
        catch (PDOException $e)
        {
            die("Query in Feedback::updateFeedback() is wrong: {$e->getMessage()}");
        }
    }

    public static function updateImage($feedback)
    {
        $db = Database::getConnection();

        try
        {
            $sql = "UPDATE feed 
                    SET image_path = :image_path 
                    WHERE id = :id";
            $feed = $db->prepare($sql);

            $feed->bindParam(':id', $feedback['id'], PDO::PARAM_INT);
            $feed->bindParam('image_path', $feedback['image_path'], PDO::PARAM_STR);
            $feed->execute();
        }
        catch (PDOException $e)
        {
            die("Query in Feedback::updateImage() is wrong: {$e->getMessage()}");
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