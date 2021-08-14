<?php
namespace App\classes;

class RouteeAccessToken extends Routee
{

    public function __construct(string $applicationId, string $applicationSecret)
    {
        parent::__construct($applicationId, $applicationSecret);        
    }

    //Gets the access token from routee. It uses the encoded version of the application id and the application secret
    public function getAccessToken(): string
    {
        $options[CURLOPT_URL] = CONFIG['routee_accesstokenurl'];
        $options[CURLOPT_CAINFO] = $this->curlCainfo;
        $options[CURLOPT_POSTFIELDS] = "grant_type=client_credentials";
        $options[CURLOPT_HTTPHEADER] = array(
            "authorization: Basic " . $this->encodeBase64(),
            "content-type: application/x-www-form-urlencoded"
        );
        
        $this->options +=$options;
           
        $decodedData = json_decode($this->processUrl());

        $this->checkResponse($decodedData);

        return $decodedData->access_token;
    }

    //Check the response from routee server
    private function checkResponse(\stdClass $result)
    {               
        if (isset($result->status) && $result->status == "401") {
            echo '<p style="color:red;">error: url:' . CONFIG['routee_accesstokenurl'] . ' did not return any data. Message returned was: ' . $result->message . ' with code :' . $result->status . '</p>';
            echo '<br>';
            echo '<pre style="border:1px solid red;">original message: ' . json_encode($result) . '<pre>';
            exit();
        }
    }
    
    /**
     * Enocdes the applicationid and the secret as defined in the tutorial
     * @return string
     */
    public function encodeBase64(): string
    {
        return base64_encode($this->applicationId . ':' . $this->applicationSecret);
    }

    /**
     * Get the value of applicationId
     * @return string
     */
    public function getApplicationId(): string
    {
        return $this->applicationId;
    }

    /**
     * Set the value of applicationId
     *     
     */
    public function setApplicationId(string $applicationId)
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
    public function setApplicationSecret(string $applicationSecret)
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
     * @param string    
     */
    public function setCurlCainfo(string $curlCainfo)
    {
        $this->curlCainfo = $curlCainfo;
    }
}
