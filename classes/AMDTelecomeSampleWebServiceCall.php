<?php
namespace App\classes;

class AMDTelecomeSampleWebServiceCall
{

    public $data;

    public function __construct()
    {
        global $argv;
        //$r = new Request();
        //$this->data = $r->body();

        echo $argv[1]."\n";
        echo $argv[2];
        die();
    }

    /**
     * Start application control flow
     * Calls the openweathermap with the specfic parameters returns the data converts them to json checks if the weather is above or below 20 C in temperture
     * and then sends the sms to the specified mobile phone
     *
     * @return void
     */
    public function start()
    {
        
        $owm = new OpenWeatherMap("Thessaloníki", "734077", "GR", "b385aa7d4e568152288b3c9f5c2458a5");
        $response = $owm->getData();

        $resArr = json_decode($response);

        if ($resArr->main->temp > 20) {
            $message =  "temperature is greater than 20C ".$this->getName()." temperture is " . $resArr->main->temp . "'";
        } else {
            $message =  $this->getName()." Temperature less than 20C. Temperture is " . $resArr->main->temp . "'";
        }

        $routee = new RouteeSms("5c5d5e28e4b0bae5f4accfec", "MGkNfqGud0");
        $mobileNumber = '+'.$this->getPhone();
        $from = "amdTelecom";

        $response = $routee->send($message, $mobileNumber, $from);
        $resArr = json_decode($response);


        return $resArr;
    }
    
    public function getName()
    {
        $val = isset($this->data['name']) ? $this->data['name'] : $this->error('name');

        return $val;
    }

    public function getPhone()
    {
        $val = isset($this->data['phone']) ? $this->data['phone'] : $this->error('phone');

        return $val;
    }

    public function error($msg){
        echo json_encode("{error : 'you need to specify a $msg'} in order to send the sms");
        exit();
    }
}
