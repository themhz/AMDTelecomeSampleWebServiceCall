Amd Telecome Service Demo for sending sms
-------------------------------------------
Example of how to communicate with the OpenWeatherMap and routee web service using curl  
There are three folders app, public and class  
The class folder keeps the required classes for the application  
The app folder has the applicaton logic  
The public folder has the minor file of the html that is used in order to comunicate the application  


What you need
-------------------------------------------
PHP 7.4 or greater  
enable Curl  
you need to specify the path for the cacert.pem file in the configuration file config.php  

how to run  
-------------------------------------------
1. run php -S localhost:8080 from the command line  
2. go to the url localhost:8080/public  
3. click "send" to send the sms and wait for the response  
4. the response will be returned in the result tab as a json string  
  
Code can be found https://github.com/themhz/AMDTelecomeSampleWebServiceCall  