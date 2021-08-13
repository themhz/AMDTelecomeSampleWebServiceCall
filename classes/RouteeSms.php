<?php
namespace App\classes;

class RouteeSms extends RouteeNet
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
    public function send($message, $mobileNumber, $from)
    {
        $options[CURLOPT_URL] = CONFIG['routee_smsurl'];
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
