<?php

namespace App\Http\Controllers;

use Exception;
use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    //
    protected function treatCodeError(Exception $e){
        if(is_numeric($e->getCode())){
            if($e->getCode() > 0) return $e->getCode();
        } else return 500;
    }
}
