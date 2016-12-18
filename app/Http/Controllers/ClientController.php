<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClientModel;
use App\Repositories\ClientRepository;

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

        $clientModel      = new ClientModel($request->all());
        $clientRepository = new ClientRepository();
        $clientModel      = $clientRepository->add($clientModel);


        return response()->json(['status' => 0, 'uid' => $clientModel->getUid()], 201);

    }

    //
}
