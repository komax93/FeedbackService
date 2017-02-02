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

        $dsn = "mysql:host={$dbConfig['host']};dbname={$dbConfig['dbname']}";
        $db = new PDO($dsn, $dbConfig['user'], $dbConfig['password']);

        $db->exec("set names utf8");

        return $db;
    }
}