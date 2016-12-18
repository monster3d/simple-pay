<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\ClientModel;
class ClientController extends Controller
{
    /**
    *
    * Temp storage data
    *
    * @var array
    *
    */
    private $storage;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function add(Request $request)
    {

        $client = new ClientModel();

        $baseClientStruct = [];
        
        $baseClientStruct = $request->input();

        return $baseClientStruct;

    }

    //
}
