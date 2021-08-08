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

Amd Telecome Service Demo for sending sms
-------------------------------------------
This application communicates with the OpenWeatherMap web service and gets the results for Thessaloniki
It checks if the temperature and sends an sms to the mobile specified. 

In order to run the application you need 
-------------------------------------------
PHP 7.4 or greater
enable Curl 
you need to specify the path for the cacert.pem file in the configuration file config.php

what is what
-------------------------------------------
there are three folders app,public and class
the class folder keeps or the classes needed for the application in order to run
the app folder has the applicaton logic
the public folder has the minor file of the html that is used in order to comunicate the application


how to run
-------------------------------------------
1. run php -S localhost:8080 from the command line 
2. go to the url localhost:8080/public
3. click "send" to send the sms and wait for the response
4. the response will be returned in the result tab as a json string
*/


require_once 'autoload.php';

$request = new Request();
$web = false;
if (isset($request->body()["web"])) {
    $web = $request->body()["web"] === 'true'? true: false;
}


$amdtelecom = new AMDTelecomeSampleWebServiceCall();

//if the request is run by web or, for example
//http://localhost:8080/app?name=somename&phone=306911111111
if ($web == true) {
    //Starting the application 
    $response = $amdtelecom->start();
    echo json_encode($response);
} else {
    //if the request is run manually, for example
    //http://localhost:8080/app?name=somename&phone=306911111111
    //or 
    //http://localhost:8080/app?name=somename&phone=306911111111&web=false
    set_time_limit((60 * 10) + 1);
    $counter = 0;
    while ($counter < 10) {
        $response = $amdtelecom->start();
        echo json_encode($response);
        echo "<br>-----------------------------------<br>";
        $counter++;
        flush();
        ob_flush();

        sleep(60);
    }
}
