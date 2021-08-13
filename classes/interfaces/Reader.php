<?php 
namespace App\classes\interfaces;

//An interface reader to be implemented by the script to check if its called by the browser or the Console
interface Reader{

    //interface to be implemented by the implementor. Gets the parameters requested either by the browser or by console
    public function getParams() : array;
    //checks if its the browser or the console
    public function isCalled(): bool;
}