<?php

class WebService{

    protected $option;

    public function __construct(){

        $this->options = array(            
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER => false,  // don't return headers
            CURLOPT_FOLLOWLOCATION => false,  // don't follow redirects
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_USERAGENT => "Eythimios Theotokatos", // name of client
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CONNECTTIMEOUT => 120,    // time-out on connect
            CURLOPT_CUSTOMREQUEST => "POST",
        );        
    }

    //Combines the two options. First options are the default curl options which can be changed
    //The second ones are the specific ones that correspond to spefic calls like the url, curlCainfo post fields and http header
    public function init($options){
        $this->options = $this->options + $options;
    }

    public function run(){

        $curl = curl_init();
        curl_setopt_array($curl, $this->options);
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        
        if ($err) {
            echo '<p style="color:red">cURL Error #:' . $err.'</p>';    
            exit();
        } else {            
            
            return $response;
        }
    }

}