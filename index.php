<?php
//
// A very simple PHP example that sends a HTTP POST to a remote site
//

require_once 'OpenWeatherMap.php';
require_once 'RouteeNet.php';

$owm = new OpenWeatherMap("Thessaloníki","734077","GR","b385aa7d4e568152288b3c9f5c2458a5");
$response = $owm->getData();


$routee = new RouteeNet("5c5d5e28e4b0bae5f4accfec", "MGkNfqGud0");
$mobileNumber = "+306911111111";
$from = "amdTelecom";

$resArr = array();
$resArr = json_decode($response);

if($resArr->main->temp>20){
    
    $message =  "temperature is greater than 20C send SMS message to +30 6911111111 with text 'Your name and Temperature more than 20C. Temperture is ".$resArr->main->temp."'";
}else{
    $message =  "send sms message to +30  6911111111 with text 'Your name and Temperature less than 20C. Temperture is ".$resArr->main->temp."'";
}

$routee->sendSMS($message, $mobileNumber, $from);



