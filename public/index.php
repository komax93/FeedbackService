<?php
// FRONT CONTROLLER

// 1. Common settings, error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start([
    'cookie_lifetime' => 86400,
]);

// 2. Including system core
define('ROOT', dirname(__DIR__));
define('APP_PATH', ROOT . '/app/');
require_once(APP_PATH . 'core/components/Autoload.php');

// 3. Initialization Router
$router = new Router();
$router->run();