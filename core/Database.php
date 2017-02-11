<?php

class Database
{
    /**
     * This static method returns database connection
     * @return PDO
     */
    public static function getConnection()
    {
        $path = ROOT . 'core/config/db_params.php';
        $dbConfig = require_once ($path);

        try
        {
            $dsn = "mysql:host={$dbConfig['host']};dbname={$dbConfig['dbname']}";

            $db = new PDO($dsn, $dbConfig['user'], $dbConfig['password']);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $db->exec("set names utf8");
        }
        catch (PDOException $e)
        {
            die("Connection is wrong. Message: " . $e->getMessage());
        }

        return $db;
    }
}