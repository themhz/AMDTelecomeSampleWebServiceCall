<?php

//This line is required to autoload the classes. I am not using composer since we are aiming for vanila php code.
spl_autoload_register(function ($class_name) {
    if (file_exists('../class/' . $class_name . '.php')) {
        require_once '../class/' . $class_name . '.php';
    }
});

//for the config file
//Requires the config.php file that has the basic configuration parameters of the app like the routee api url and the openweather url
$config = require_once 'config.php';
define('CONFIG', $config);
