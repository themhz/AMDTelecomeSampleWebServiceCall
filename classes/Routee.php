<?php

namespace App\classes;

class Routee extends WebApi
{
    protected string $applicationId; //The application id used in the Routee API: Example: 5c5d5e28e4b0bae5f4accfec  
    protected $applicationSecret; //The application secret used in the Routee API: Example: MGkNfqGud0 
    protected $curlCainfo; //curl.cainfo in php.ini file
    
    public function __construct($applicationId, $applicationSecret){

        $this->applicationId = $applicationId;
        $this->applicationSecret = $applicationSecret;
        $this->curlCainfo = CONFIG['routee_curlcainfo'];
        parent::__construct();
    }

}