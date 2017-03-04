<?php
/**
 * Autoloader
 * Auto load classes from app/models/, core/ directories
 */
spl_autoload_register(function($className){
    $paths = array(
        'models/',
        'core/components/',
    );

    foreach ($paths as $path)
    {
        $file = APP_PATH . $path . $className . '.php';

        if(is_file($file))
        {
            require_once $file;
        }
    }
});