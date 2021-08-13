<?php
namespace App\app;

use App\classes\handlers\WebHandler;
use App\classes\handlers\ConsoleHandler;

class App
{

    public function start()
    {
        $reader = new WebHandler();
        if ($reader->isCalled()) {
            print_r($reader->getParams());
        }

        $reader = new ConsoleHandler();
        if ($reader->isCalled()) {
            print_r($reader->getParams());
        }


        //$amdtelecom = new AMDTelecomeSampleWebServiceCall();

        // set_time_limit((60 * 10) + 1);
        // $counter = 0;
        // while ($counter < 10) {
        //     $response = $amdtelecom->start();
        //     echo json_encode($response);
        //     echo "<br>-----------------------------------<br>";
        //     $counter++;
        //     flush();
        //     ob_flush();

        //     sleep(60);
        // }

    }
}
