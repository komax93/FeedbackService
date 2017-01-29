<?php

function __autoload($className)
{
    $paths = array(
        'models/',
        'controllers/',
    );

    foreach($paths as $path)
    {
        $file = ROOT . $path . $className . '.php';

        if(is_file($file))
        {
            include_once $file;
        }
    }
}