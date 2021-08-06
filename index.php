<?php
/*About
----------------------------------------------------------------
Asignment from https://www.amdtelecom.net/ 
User gets a mechanism capable to examine whether data and depending
on the temperature and send sms message to a specified number.
This appliation is using Weather Api from https://openweathermap.org/  to access current weather data for the Thessaloniki.
API documentation https://openweathermap.org/api
Uses the endpoint api.openweathermap.org for your API calls
*/


//Requires the config.php file that has the basic configuration parameters of the app like the routee api url and the openweather url
require_once 'config.php';

//This line is required to autoload the classes. I am not using composer since we are aiming for vanila php code.
spl_autoload_register(function ($class_name) {
    require_once 'class/'.$class_name . '.php';
});

$amdtelecom = new AMDTelecomeSampleWebServiceCall();
$amdtelecom->start();