<?php
/**
 * Autoloader
 * Auto load classes from app/models/, core/ directories
 */
spl_autoload_register(function($className){
    $paths = array(
        'app/models/',
        'core/',
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