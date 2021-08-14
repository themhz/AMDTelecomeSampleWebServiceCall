<?php
namespace App\classes;

class OpenWeatherMap extends WebApi
{

    private $cityName;
    private $stateCode;
    private $countryCode;
    private $apiKey;
    private $url;
    private $units;

    public function __construct(string $cityName = "", string $stateCode = "", string $countryCode = "", string  $apiKey = "", string  $units = "metric")
    {        
        $this->cityName = $cityName;
        $this->stateCode = $stateCode;
        $this->countryCode = $countryCode;
        $this->apiKey = $apiKey;
        $this->units = $units;   

        $this->url = CONFIG["openweathermap_accesstokenurl"] . '?q='. $this->cityName . ','. $this->stateCode . ','. $this->countryCode . '&units='. $this->units . '&appid='. $this->apiKey;
        parent::__construct();
    }

    /**
     * Get data from OpenWeatherMap
     * @return  string
     * With the weather information from the url specified in the Config::read('openweathermap.accesstokenurl') in the config file
     */
    public function getData()
    {
        $options[CURLOPT_URL] = $this->url;

        $this->init($options);

        $result = $this->processUrl();

        $this->checkResponse($result);

        return $result;
    }


    private function checkResponse($result)
    {
        $check = json_decode($result);
        if (isset($check->cod) && $check->cod == 404) {
            echo '<p style="color:red;">error: no weather data because server returned ' . $check->message . ' with code :' . $check->cod . '</p>';
            echo '<br>';
            echo '<pre style="border:1px solid red;">original message: ' . $result . '<pre>';
            exit();
        }
    }    
}
