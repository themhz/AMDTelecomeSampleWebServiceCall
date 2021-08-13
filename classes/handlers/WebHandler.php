<?php
namespace App\classes\handlers;

use App\classes\handlers\RequestHandler;
use App\classes\interfaces\Reader;

class WebHandler extends RequestHandler implements Reader
{

    private $name;
    private $phone;

    public function __construct(){
        
    }
    
    //Gets the parameters requested by the console
    public function getParams(): array
    {
        $this->name = $this->getfield("name");
        $this->phone= $this->getfield("phone");
        return ['name' => $this->getName(), 'phone' => $this->getPhone()];
    }
    //checks if its the browser or the console
    public function isCalled(): bool
    {
        return (php_sapi_name() == 'cli-server');
    }
    /**
     * Get the value of name
     */
    public function getName(): string
    {
        return !empty($this->name)? $this->name : "";        
    }

    /**
     * Set the value of name
     *
     * @return  self
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * Get the value of phone
     */
    public function getPhone(): string
    {
        return !empty($this->phone)? $this->phone : "";
    }

    /**
     * Set the value of phone
     *
     * @return  self
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    }
}
