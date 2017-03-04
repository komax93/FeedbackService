<?php
// FRONT CONTROLLER

// 1. Common settings, error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();

// 2. Including system core
define('ROOT', dirname(__FILE__) . '/../');
require_once(ROOT . 'app/core/components/Autoload.php');

// 3. Initialization Router
$router = new Router();
$router->run();