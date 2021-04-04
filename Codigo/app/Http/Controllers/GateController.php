<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\GateService;

class GateController extends Controller
{
    public $service;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->service = new GateService();
    }

    public function index(){
        return $this->service->getAll();
    }

    //
}
