<?php

require_once APP_PATH . 'core/vendor/smarty/smarty/libs/Smarty.class.php';

class Viewer
{
    private static $instance;

    private function __construct(){}

    public static function getInstance()
    {
        if(empty(self::$instance))
        {
            $smarty = new Smarty();
            $smarty->template_dir = APP_PATH . 'views/templates';
            $smarty->compile_dir = APP_PATH . 'views/templates/tmp';
            
            self::$instance = $smarty;
        }

        return self::$instance;
    }
}