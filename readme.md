Amd Telecome Service Demo for sending sms
-------------------------------------------
Example of how to communicate with the OpenWeatherMap and routee web service  


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
  
Code can be found https://github.com/themhz/AMDTelecomeSampleWebServiceCall  