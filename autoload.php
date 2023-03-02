<?php

spl_autoload_register('myAutoloader');

function myAutoloader($className) {
    
    if(str_contains('Controller', $className)) {
        $path = '../Controller/';
    }

    $path = '../Models/';
    $extension = '.php';
    $fullPath = $path . $className . $extension;
    include $fullPath;
}
