<?php

namespace App\classes;

use App\classes\handlers\DisplayHandler;

class AMDTelecomeSampleWebServiceCall
{

    public $name;
    public $phone;

    public $cityName;
    public $stateCode;
    public $countryCode;
    public $apiKey;
    public $units;

    public $routeeApplicationId;
    public $routeeapplicationSecret;


    /**
     * Start application control flow
     * Calls the openweathermap with the specfic parameters returns the data converts them to json checks if the weather is above or below 20 C in temperture
     * and then sends the sms to the specified mobile phone
     *
     * @return void
     */
    public function start()
    {

        $response = $this->getWeatherMap($this->cityName, $this->stateCode, $this->countryCode, $this->apiKey);

        $message = $this->checkTemperature($response->main->temp);

        $accessToken = $this->getRouteeAccessToken();

        $resultSMS = $this->sendRouteeSms($message, "amdTelecom", $accessToken);
        
        return $resultSMS;                
    }


    public function getWeatherMap(string $cityName = "", string $stateCode = "", string $countryCode = "", string  $apiKey = "", string  $units = "metric")
    {
        $owm = new OpenWeatherMap($cityName, $stateCode, $countryCode, $apiKey, $units);

        $response = $owm->getData();
        return json_decode($response);
    }

    public function checkTemperature($temp)
    {

        if ($temp > 20) {
            return  "temperature is greater than 20C " . $this->getName() . " temperture is " . $temp . "'";
        } else {
            return  $this->getName() . " Temperature less than 20C. Temperture is " . $temp . "'";
        }
    }

    public function getRouteeAccessToken()
    {
        $routeeNet =  new RouteeAccessToken($this->routeeApplicationId, $this->routeeapplicationSecret);
        return $routeeNet->getAccessToken();
    }

    public function sendRouteeSms($message, $from, $accessToken){
        $routeeSMS = new RouteeSms($this->routeeApplicationId, $this->routeeapplicationSecret);
        return $routeeSMS->send($message, $this->phone, $from, $accessToken);        
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        $val = isset($this->name) ? $this->name : $this->error('name');

        return $val;
    }


    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    public function getPhone()
    {
        $val = isset($this->phone) ? $this->phone : $this->error('phone');

        return $val;
    }


    public function getCityName()
    {
        $val = isset($this->cityName) ? $this->cityName : $this->error('cityName');

        return $val;
    }


    public function setCityName($cityName)
    {
        $this->cityName = $cityName;
    }


    public function getStateCode()
    {
        $val = isset($this->stateCode) ? $this->stateCode : $this->error('stateCode');
        return $val;
    }


    public function setStateCode($stateCode)
    {
        $this->stateCode = $stateCode;
        return $this;
    }

    public function getCountryCode()
    {
        $val = isset($this->countryCode) ? $this->countryCode : $this->error('countryCode');

        return $val;
    }


    public function setCountryCode($countryCode)
    {
        $this->countryCode = $countryCode;

        return $this;
    }

    public function getApiKey()
    {
        $val = isset($this->apiKey) ? $this->apiKey : $this->error('apiKey');

        return $val;
    }


    public function setApiKey($apiKey)
    {
        $this->apiKey = $apiKey;

        return $this;
    }


    public function getUnits()
    {
        return $this->units;
    }


    public function setUnits($units)
    {
        $this->units = $units;

        return $this;
    }


    public function error($msg)
    {
        echo json_encode("{error : 'you need to specify a $msg'} in order to send the sms");
        exit();
    }
}
