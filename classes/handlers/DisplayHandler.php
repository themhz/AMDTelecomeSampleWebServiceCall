<?php

namespace App\classes\handlers;

/**
 * Class to help print messeges in a stylee way
 * 
 */
class DisplayHandler{

    static public function jsonencode($in){
        echo "<pre>";
        print_r(json_encode($in));
        echo "</pre>";
    }

    static public function jsondecode($in){
        echo "<pre>";
        print_r(json_decode($in));
        echo "</pre>";
    }

    static public function print($in){
        echo "<pre>";
        print_r($in);
        echo "</pre>";        
    }


    
}