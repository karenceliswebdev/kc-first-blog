<?php

spl_autoload_register('myAutoloader');

function myAutoloader($className) {
    
    $path = '../Models/';
    $extension = '.php';
    $fullPath = $path . $className . $extension;
    
    include $fullPath;
};