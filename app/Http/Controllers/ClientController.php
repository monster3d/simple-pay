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
        //void
    }

    /**
    *
    * Contorller add new client
    *
    * @param $request Illuminate\Http\Request
    *
    * @return array
    *
    * @todo Need added validation input data
    *
    */
    public function add(Request $request)
    {

        $clientModel      = new ClientModel($request->all());
        $clientRepository = new ClientRepository();
        
        try {
            $clientModel      = $clientRepository->add($clientModel);
        } catch (PDOException $e) {
            //@todo logger
        } catch (Exception $e) {
            //@todo logger
        }

        unset($clientRepository);

        return response()->json(['status' => 0, 'uid' => $clientModel->getUid()], 201);
    }

    /**
    *
    * Get client info by uid
    *
    * @param $request Illuminate\Http\Request
    * @param $uid int
    *
    * @return array
    *
    */
    public function info(Request $request, $uid)
    {
        $clientModel = new ClientModel();
        $clientModel->setUid($uid);
        $clientRepository = new ClientRepository();
        try {
            $clientModel = $clientRepository->get($clientModel); 
        } catch (PDOException $e) {
            //@todo logger
        } catch (Exception $e) {
            //@todo logger
        }
        
        $response = [
            'status' => 0,
            'data' => [
                'client' => [
                    'name'        => $clientModel->getName(),
                    'country'     => $clientModel->getCountry(),
                    'city'        => $clientModel->getCity(),
                    'currency'    => $clientModel->getCurrency(),
                    'amount'      => $clientModel->getAmount(),
                    'last_active' => $clientModel->getLastActive()
               ]
            ]
        ];
        return response()->json($response, 200);
    }
}
