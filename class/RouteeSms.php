<?php

class RouteeSms extends RouteeNet
{


    public function __construct(string $applicationId, string $applicationSecret)
    {
        parent::__construct($applicationId, $applicationSecret);
    }

    //Sends the sms using the routee.net web services sms method
    public function send($message, $mobileNumber, $from)
    {
        $options[CURLOPT_URL] = Config::read('routee.smsurl');
        $options[CURLOPT_CAINFO] = $this->curlCainfo;
        $options[CURLOPT_POSTFIELDS] = "{ \"body\": \"$message\",\"to\" : \"$mobileNumber\",\"from\": \"$from\"}";
        $options[CURLOPT_HTTPHEADER] = array(
            "authorization: Bearer " . $this->getAccessToken(),
            "content-type: application/json"
        );

        $ws = new WebService();
        $ws->init($options);
        
       return $ws->run();
              
    }
}
