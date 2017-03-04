<?php

class Database
{
    private static $connection;

    private function __construct(){}

    public static function getConnection()
    {
        if(empty(self::$connection))
        {
            $path = ROOT . 'app/core/config/db_params.php';
            $dbConfig = require_once ($path);

            try
            {
                $dsn = "mysql:host={$dbConfig['host']};dbname={$dbConfig['dbname']}";
                $db = new PDO($dsn, $dbConfig['user'], $dbConfig['password']);
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $db->exec("set names utf8");

                self::$connection = $db;
            }
            catch (PDOException $e)
            {
                die("Connection is wrong. Message: " . $e->getMessage());
            }
        }

        return self::$connection;
    }
}