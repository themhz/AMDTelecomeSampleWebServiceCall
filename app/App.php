<?php

namespace App\app;

use App\classes\handlers\WebHandler;
use App\classes\handlers\ConsoleHandler;
use App\classes\handlers\DisplayHandler;
use App\classes\AMDTelecomeSampleWebServiceCall;

class App
{
    public object $params;
    public bool $isWeb = false;
    public AMDTelecomeSampleWebServiceCall $amdtelecom;

    public function __construct()
    {
        $this->checkRunningEnvoroment();
    }

    public function checkRunningEnvoroment()
    {
        $reader = new WebHandler();
        if ($reader->isCalled()) {
            $this->params = $reader->getParams();
            $this->isWeb = true;
        }

        $reader = new ConsoleHandler();
        if ($reader->isCalled()) {
            $this->params = $reader->getParams();
        }
    }

    public function start()
    {

        $this->amdtelecom = new AMDTelecomeSampleWebServiceCall();
        $this->amdtelecom->name = $this->params->name;
        $this->amdtelecom->phone = $this->params->phone;
        $this->amdtelecom->cityName = "Thessaloníki";
        $this->amdtelecom->stateCode = "734077";
        $this->amdtelecom->countryCode = "GR";
        $this->amdtelecom->apiKey = "b385aa7d4e568152288b3c9f5c2458a5";
        $this->amdtelecom->units = "metric";

        $this->amdtelecom->routeeApplicationId = "5c5d5e28e4b0bae5f4accfec";
        $this->amdtelecom->routeeapplicationSecret = "MGkNfqGud0";

        $this->run();
    }

    public function run()
    {
        if ($this->isWeb) {
            $this->runForWeb();
        } else {
            $this->runForConsole();
        }
    }

    public function runForWeb()
    {
        $response = $this->amdtelecom->start();
        DisplayHandler::print($response);
    }

    public function runForConsole()
    {

        set_time_limit((60 * 10) + 1);
        $counter = 0;
        while ($counter < 10) {
            $response = $this->amdtelecom->start();
            echo json_encode($response);
            echo "\n ----------------------------------- \n";
            $counter++;
            flush();
            ob_flush();

            sleep(60);
        }
    }
}
