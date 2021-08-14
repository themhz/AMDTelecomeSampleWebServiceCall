Amd Telecome Service Demo for sending sms
-------------------------------------------
Example of how to communicate with the OpenWeatherMap and routee web service using curl  
You will find the following folders in the root: app, public, class, vendor  
The class folder keeps the required classes for the application  
In class folder you will find two more folders:handlers and interfaces.  

The app folder has the applicaton controll flow  
The public folder has an html that can be used to run the app from the web  

What you need
-------------------------------------------
PHP 7.4 or greater   
enable Curl   
you need to specify the path for the cacert.pem file in the configuration file config.php  

How to run   
-------------------------------------------
You can run the application from the console and from the web  

Running from the Web  
-------------------------------------------
1. run php -S localhost:8080 from the command line from the application root  
2. go to the url localhost:8080  
3. click "send" to send the sms and wait for the response (Response will come after 60 seconds and it will run 10 times Total 10 minuets)  
4. the response will be returned in the result textbox as a json string    

Running from the Console  
-------------------------------------------   
1. run php index.php name phone  
2. the result will appear in the console (The process will run for 10 minuets)  

