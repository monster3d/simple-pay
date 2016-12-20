<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WebController extends Controller {
     
     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //void
    }

    public function index()
    {
        return view('index', []);
    }
}