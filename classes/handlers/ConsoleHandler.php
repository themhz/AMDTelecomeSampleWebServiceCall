<?php
namespace App\classes\handlers;
use App\classes\interfaces\Reader;

class ConsoleHandler implements Reader
{    
    
    //Gets the parameters requested by the console
    public function getParams(): array
    {
       
        return ['name' => $this->getName(), 'phone' => $this->getPhone()];
    }
    //checks if its the browser or the console
    public function isCalled(): bool
    {
        return (php_sapi_name() == 'cli');
    }

    /**
     * Get the value of name
     */
    public function getName(): string
    {
        global $argv;
        return !empty($argv[1])?$argv[1]:"";
    }

  

    /**
     * Get the value of phone
     */
    public function getPhone(): string
    {
        global $argv;
        return !empty($argv[2])?$argv[2]:"";
    }

   
}
