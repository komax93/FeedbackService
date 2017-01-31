<?php

function __autoload($className)
{
    $paths = array(
        'models/',
        'components/',
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