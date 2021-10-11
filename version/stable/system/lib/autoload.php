<?php

function autoload ($dir)
{
    $files = scandir($dir);
    foreach ($files as $file) {

        if (($file !== '.') and ($file !== '..')) {
            if (is_dir($dir.'/'.$file)) {
                autoload($dir.'/'.$file);
            }
            if (is_file($dir.'/'.$file)) {
                require_once $dir.'/'.$file;
            }
        }
    }
}


// Загрузка vendor.
require_once 'vendor/autoload.php';

// Загрузка своей библиотеки.
autoload(__DIR__.'/my/');
