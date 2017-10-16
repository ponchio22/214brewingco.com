<?php

function __autoload($class_name) {
    $GLOBALS['root'] = dirname(__FILE__)."/../";
    $class_filename = str_replace('\\', '/', $class_name);
    $filename = dirname(__FILE__) . "/" . $class_filename . '.php';
    if(file_exists($filename)) {
        require_once $filename;
        return;
    } 
    $filename = dirname(__FILE__) . "/../bundles/" . $class_filename . '.php';
    if(file_exists($filename)) {
        require_once $filename;
        return;
    }    
} 
