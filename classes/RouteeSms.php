<?php

namespace App\classes;

class RouteeSms extends Routee
{
    /**
     * Constructor to call the parent constructor
     */
    public function __construct(string $applicationId, string $applicationSecret)
    {
        parent::__construct($applicationId, $applicationSecret);
    }


    /**
     * Sends the sms using the routee.net web services sms method
     *
     * @return string
     */
    public function send($message, $mobileNumber, $from, $accessToken)
    {
        $options[CURLOPT_URL] = CONFIG['routee_smsurl'];
        $options[CURLOPT_CAINFO] = $this->curlCainfo;
        $options[CURLOPT_POSTFIELDS] = "{ \"body\": \"$message\",\"to\" : \"$mobileNumber\",\"from\": \"$from\"}";
        $options[CURLOPT_HTTPHEADER] = array(
            "authorization: Bearer " . $accessToken,
            "content-type: application/json"
        );

        $this->options += $options;


        return $this->processUrl();
    }
}
