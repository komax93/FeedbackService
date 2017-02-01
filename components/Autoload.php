<?php
/**
 * Autoloader
 * Auto load classes from models/, components/ directories
 */
spl_autoload_register(function($className){
    $paths = array(
        'models/',
        'components/',
    );

    foreach ($paths as $path)
    {
        $file = ROOT . $path . $className . '.php';

        if(is_file($file))
        {
            require_once $file;
        }
    }
});