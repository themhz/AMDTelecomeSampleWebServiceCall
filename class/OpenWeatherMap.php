<?php

class OpenWeatherMap
{

    private $cityName;
    private $stateCode;
    private $countryCode;
    private $apiKey;
    private $url;
    private $units;

    public function __construct($cityName = "", $stateCode = "", $countryCode = "", $apiKey = "", $units = "metric")
    {
        $this->cityName = $cityName;
        $this->stateCode = $stateCode;
        $this->countryCode = $countryCode;
        $this->apiKey = $apiKey;
        $this->units = $units;
        $this->url = Config::read('openweathermap.accesstokenurl') . '?q='
            . $this->cityName . ','
            . $this->stateCode . ','
            . $this->countryCode . '&units='
            . $this->units . '&appid='
            . $this->apiKey;
    }

    /**
     * Get data from OpenWeatherMap
     * @return  string
     * With the weather information from the url specified in the Config::read('openweathermap.accesstokenurl') in the config file
     */
    public function getData()
    {     
        $options[CURLOPT_URL] = $this->url;
        $ws = new WebService();
        $ws->init($options);

        $result = $ws->run();

        $this->checkResponse($result); 

        return $result;
    }


    private function checkResponse($result){
        $check = json_decode($result);
        if($check->cod == 404){
            echo '<p style="color:red;">error: no weather data because server returned '.$check->message. ' with code :'.$check->cod.'</p>';
            echo '<br>';            
            echo '<pre style="border:1px solid red;">original message: '. $result . '<pre>';
            exit();
        }
    }
    /**
     * Get the value of cityName
     * @return  string
     */
    public function getCityName()
    {
        return $this->cityName;
    }

    /**
     * Set the value of cityName     
     */
    public function setCityName($cityName)
    {
        $this->cityName = $cityName;
    }

    /**
     * Get the value of stateCode
     * @return  string
     */
    public function getStateCode()
    {
        return $this->stateCode;
    }

    /**
     * Set the value of stateCode
     *     
     */
    public function setStateCode($stateCode)
    {
        $this->stateCode = $stateCode;
    }

    /**
     * Get the value of countryCode
     * @return  string
     */
    public function getCountryCode()
    {
        return $this->countryCode;
    }

    /**
     * Set the value of countryCode
     * @return  string
     */
    public function setCountryCode($countryCode)
    {
        $this->countryCode = $countryCode;
    }

    /**
     * Get the value of apiKey
     * @return  string
     */
    public function getApiKey()
    {
        return $this->apiKey;
    }

    /**
     * Set the value of apiKey          
     */
    public function setApiKey($apiKey)
    {
        $this->apiKey = $apiKey;
    }
}
