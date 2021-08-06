<?php

require_once 'config.php';
require_once 'class/WebService.php';
require_once 'class/OpenWeatherMap.php';
require_once 'class/RouteeNet.php';
require_once 'class/RouteeSms.php';


$owm = new OpenWeatherMap("Thessaloníki", "734077", "GR", "b385aa7d4e568152288b3c9f5c2458a5");
$response = $owm->getData();


$routee = new RouteeSms("5c5d5e28e4b0bae5f4accfec", "MGkNfqGud0");
$mobileNumber = "+306911111111";
$from = "amdTelecom";


$resArr = json_decode($response);

// echo "<pre>";
// print_r($resArr);
// echo "</pre>";

if ($resArr->main->temp > 20) {
    $message =  "temperature is greater than 20C send SMS message to +30 6911111111 with text 'Your name and Temperature more than 20C. Temperture is " . $resArr->main->temp . "'";
} else {
    $message =  "send sms message to +30  6911111111 with text 'Your name and Temperature less than 20C. Temperture is " . $resArr->main->temp . "'";
}

$response = $routee->send($message, $mobileNumber, $from);
$resArr = json_decode($response);

 echo "<pre>";
 print_r($resArr);
 echo "</pre>";
