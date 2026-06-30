<?php
    $folderPasth = dirname($_SERVER['SCRIPT_NAME']);
    $urlPasth = $_SERVER['REQUEST_URI'];
    $url = substr($urlPasth,strlen($folderPasth));

    define('URL', $url);
    define('URL_PATH', $folderPasth);
