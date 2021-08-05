<?php

class RouteeNet
{

    private $applicationId;
    private $applicationSecret;
    private $curlCainfo; //curl.cainfo in php.ini file


    public function __construct($applicationId, $applicationSecret)
    {

        $this->applicationId = $applicationId;
        $this->applicationSecret = $applicationSecret;
        $this->curlCainfo = "C:\\wamp64\\bin\\php\\php7.3.12\\extras\\ssl\\cacert.pem";
    }

    public function sendSMS($message, $mobileNumber, $from)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_CAINFO, $this->curlCainfo);

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://connect.routee.net/sms",
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
    public function getAccessToken()
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_CAINFO, $this->curlCainfo);

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://auth.routee.net/oauth/token",
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

    public function encodeBase64()
    {

        return base64_encode($this->applicationId . ':' . $this->applicationSecret);
    }
}
