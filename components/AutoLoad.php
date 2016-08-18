<?php

function __autoload($className)
{
    $arrayPaths = array(
        '/models/',
        '/components/',
        '/controllers/'
    );

    foreach ($arrayPaths as $path) {
        $path = ROOT . $path . $className . '.php';
        if (file_exists($path))
            include_once $path;
    }
}