<?php

class Request{

    public function __construct(){}

    /**
     * Returns the HTTP requested method
     *
     * @return string of the requested HTTP method in lower case
     */
    public function method() : string
    {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }

    /**
     * Gets the body of the http request from post or put or get etc.. and filters the input sanitizing the request
     *
     * @return array
     */ 
    public function body() : array
    {
        $body = [];
        if ($this->method() === 'get') {
            foreach ($_GET as $key => $value) {
                $body[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }

        if ($this->method() === 'post') {
            foreach ($_POST as $key => $value) {
                $body[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }

            //check if post method uses a json string and not form data
            if(empty($body)){
                $data = file_get_contents('php://input');
                if($this->isJson($data)){
                    $data = json_decode($data);
                    foreach ($data as $key => $value) {
                        $body[$key] = $value;
                    }                    
                }
            }
        }

                
        if ($this->method() === 'put') {
            $putdata = file_get_contents('php://input');
            $putdata = explode("&", $putdata);
            foreach ($putdata as $putitem) {
                $data = explode("=", $putitem);
                $body[$data[0]] = urldecode(filter_var($data[1], FILTER_SANITIZE_SPECIAL_CHARS));
            }
        }

        if ($this->method() === 'delete') {

            $putdata = file_get_contents('php://input');
            $putdata = explode("&", $putdata);
            foreach ($putdata as $putitem) {
                $data = explode("=", $putitem);
                $body[$data[0]] = urldecode(filter_var($data[1], FILTER_SANITIZE_SPECIAL_CHARS));
            }
        }

        return $body;
    }

    public function isJson($string) {
        json_decode($string);
        return json_last_error() === JSON_ERROR_NONE;
     }
}