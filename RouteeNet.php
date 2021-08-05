<?php

class RouteeNet
{

    protected $applicationId; //The application id used in the Routee API: Example: 5c5d5e28e4b0bae5f4accfec  
    protected $applicationSecret; //The application secret used in the Routee API: Example: MGkNfqGud0 
    protected $curlCainfo; //curl.cainfo in php.ini file


    public function __construct(string $applicationId, string $applicationSecret)
    {

        $this->applicationId = $applicationId;
        $this->applicationSecret = $applicationSecret;
        $this->curlCainfo = Config::read('routee.curlcainfo');
    }

    //Gets the access token from routee. It uses the encoded version of the application id and the application secret
    public function getAccessToken(): string
    {
        $options[CURLOPT_URL] = Config::read('routee.accesstokenurl');
        $options[CURLOPT_CAINFO] = $this->curlCainfo;
        $options[CURLOPT_POSTFIELDS] = "grant_type=client_credentials";
        $options[CURLOPT_HTTPHEADER] = array(
            "authorization: Basic " . $this->encodeBase64(),
            "content-type: application/x-www-form-urlencoded"
        );

        $ws = new WebService();
        $ws->init($options);
        $decodedData = json_decode($ws->run());
        return $decodedData->access_token;
    }

    //Enocdes the applicationid and the secret as defined in the tutorial
    public function encodeBase64(): string
    {
        return base64_encode($this->applicationId . ':' . $this->applicationSecret);
    }

    /**
     * Get the value of applicationId
     * @return  string
     */
    public function getApplicationId(): string
    {
        return $this->applicationId;
    }

    /**
     * Set the value of applicationId
     *     
     */
    public function setApplicationId($applicationId)
    {
        $this->applicationId = $applicationId;
    }

    /**
     * Get the value of applicationSecret
     * @return  string
     */
    public function getApplicationSecret(): string
    {
        return $this->applicationSecret;
    }

    /**
     * Set the value of applicationSecret
     *     
     */
    public function setApplicationSecret($applicationSecret)
    {
        $this->applicationSecret = $applicationSecret;
    }

    /**
     * Get the value of curlCainfo
     * @return  string
     */
    public function getCurlCainfo(): string
    {
        return $this->curlCainfo;
    }

    /**
     * Set the value of curlCainfo
     *     
     */
    public function setCurlCainfo($curlCainfo)
    {
        $this->curlCainfo = $curlCainfo;
    }
}
