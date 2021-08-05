<?php

class RouteeNet
{

    private $applicationId; //The application id used in the Routee API: Example: 5c5d5e28e4b0bae5f4accfec  
    private $applicationSecret; //The application secret used in the Routee API: Example: MGkNfqGud0 
    private $curlCainfo; //curl.cainfo in php.ini file


    public function __construct(string $applicationId, string $applicationSecret)
    {

        $this->applicationId = $applicationId;
        $this->applicationSecret = $applicationSecret;
        $this->curlCainfo = Config::read('routee.curlcainfo');
    }

    //Sends the sms using the routee.net web services sms method
    public function sendSMS($message, $mobileNumber, $from)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_CAINFO, $this->curlCainfo);

        curl_setopt_array($curl, array(
            CURLOPT_URL => Config::read('routee.smsurl'),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "{ \"body\": \"$message\",\"to\" : \"$mobileNumber\",\"from\": \"$from\"}",
            CURLOPT_HTTPHEADER => array(
                "authorization: Bearer ".$this->getAccessToken(),
                "content-type: application/json"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            echo "<pre>";
            print_r($response);
            echo "</pre>";
        }
    }

    //Gets the access token from routee. It uses the encoded version of the application id and the application secret
    public function getAccessToken() : string
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_CAINFO, $this->curlCainfo);

        curl_setopt_array($curl, array(
            CURLOPT_URL => Config::read('routee.accesstokenurl'),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "grant_type=client_credentials",
            CURLOPT_HTTPHEADER => array(
                "authorization: Basic " . $this->encodeBase64(),
                "content-type: application/x-www-form-urlencoded"
            ),
        ));


        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        if ($err) {
            return "cURL Error #:" . $err;
        } else {;
            $decodedData = json_decode($response);
            return $decodedData->access_token;
        }
    }

    //Enocdes the applicationid and the secret as defined in the tutorial
    public function encodeBase64() : string
    {
        return base64_encode($this->applicationId . ':' . $this->applicationSecret);
    }

    /**
     * Get the value of applicationId
     * @return  string
     */ 
    public function getApplicationId() : string
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
    public function getCurlCainfo() : string
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
