<?php

namespace App\Http\Controllers;

use Exception;
use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    //
    protected function treatCodeError(Exception $e){
        $code = $e->getCode();
        if(is_numeric($code)){
            if($code >= 100 && $code < 600) return $code;
            else return 500;
        } else return 500;
    }
}
