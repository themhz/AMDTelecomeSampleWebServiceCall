<?php
/* 
About
----------------------------------------------------------------
Asignment from https://www.amdtelecom.net/ 
User gets a mechanism capable to examine whether data and depending
on the temperature and send sms message to a specified number.
This appliation is using Weather Api from https://openweathermap.org/  to access current weather data for the Thessaloniki.
API documentation https://openweathermap.org/api
Uses the endpoint api.openweathermap.org for your API calls

Dependencies
----------------------------------------------------------------
Using vanila PHP version 7.2 and greater
Php Curl

How is it working
----------------------------------------------------------------

*/
require_once 'autoload.php';


//Starting the application 
$amdtelecom = new AMDTelecomeSampleWebServiceCall();
$amdtelecom->start();
