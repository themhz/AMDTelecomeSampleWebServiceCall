<?php 

class OpenWeatherMap{

    private $cityName;
    private $stateCode;
    private $countryCode;
    private $apiKey;
    private $url;
    private $units;

    public function __construct($cityName="", $stateCode="", $countryCode="", $apiKey="", $units="metric"){
        $this->cityName = $cityName;
        $this->stateCode = $stateCode;
        $this->countryCode = $countryCode;
        $this->apiKey = $apiKey;        
        $this->units = $units;
        $this->url = Config::read('openweathermap.accesstokenurl').'?q='.$this->cityName.','.$this->stateCode.','.$this->countryCode.'&units='.$this->units.'&appid='.$this->apiKey;        
    }

    public function getData(){
        $options = array(
            CURLOPT_RETURNTRANSFER => true,   // return web page
            CURLOPT_HEADER         => false,  // don't return headers
            CURLOPT_FOLLOWLOCATION => true,   // follow redirects
            CURLOPT_MAXREDIRS      => 10,     // stop after 10 redirects
            CURLOPT_ENCODING       => "",     // handle compressed
            CURLOPT_USERAGENT      => "test", // name of client
            CURLOPT_AUTOREFERER    => true,   // set referrer on redirect
            CURLOPT_CONNECTTIMEOUT => 120,    // time-out on connect
            CURLOPT_TIMEOUT        => 120,    // time-out on response
        ); 
    
        $ch = curl_init($this->url);
        curl_setopt_array($ch, $options);
    
        $content  = curl_exec($ch);
    
        curl_close($ch);
    
        return $content;
    }


    /**
     * Get the value of cityName
     */ 
    public function getCityName()
    {
        return $this->cityName;
    }

    /**
     * Set the value of cityName
     *
     * @return  self
     */ 
    public function setCityName($cityName)
    {
        $this->cityName = $cityName;

        return $this;
    }

    /**
     * Get the value of stateCode
     */ 
    public function getStateCode()
    {
        return $this->stateCode;
    }

    /**
     * Set the value of stateCode
     *
     * @return  self
     */ 
    public function setStateCode($stateCode)
    {
        $this->stateCode = $stateCode;

        return $this;
    }

    /**
     * Get the value of countryCode
     */ 
    public function getCountryCode()
    {
        return $this->countryCode;
    }

    /**
     * Set the value of countryCode
     *
     * @return  self
     */ 
    public function setCountryCode($countryCode)
    {
        $this->countryCode = $countryCode;

        return $this;
    }

    /**
     * Get the value of apiKey
     */ 
    public function getApiKey()
    {
        return $this->apiKey;
    }

    /**
     * Set the value of apiKey
     *
     * @return  self
     */ 
    public function setApiKey($apiKey)
    {
        $this->apiKey = $apiKey;

        return $this;
    }
}