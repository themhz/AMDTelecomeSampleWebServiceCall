<?php
namespace App\classes;

class WebService{

    protected $options;

    /**
     * Constructor that creates the default options for the curl 
     */
    public function __construct(){

        $this->options = array(            
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER => false, 
            CURLOPT_FOLLOWLOCATION => false,  
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_USERAGENT => "Eythimios Theotokatos",
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CONNECTTIMEOUT => 120,    
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_VERBOSE =>1
        );        
    }
        
    /**
     * Combines the two options. First options are the default curl options which can be changed
     * The second ones are the specific ones that correspond to spefic calls like the url, curlCainfo post fields and http header
     *
     * @param array $options
     */
    public function init(array $options){
        $this->options = (array) $this->options + $options;
    }

    /**
     * returns a json string to the caller but if there is an error it will halt the program and print the error message
     *
     * @return string
     */
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