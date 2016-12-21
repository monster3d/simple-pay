<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TransferModel;
use App\Repositories\TransferRepository;
use \Exception;

class TransferController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // void
    }

    public function transfer(Request $request)
    {
        $response = [
            'status'  => 0,
            'message' => ''
        ];
        $transferModel = new TransferModel($request->all());
        $transferRepository = new TransferRepository();
        try {
            $transferModel = $transferRepository->clientToClient($transferModel);
            $response['status'] = $transferModel->getStatus();
        } catch (PDOException $e) {
            //@todo logger
        } catch (Exception $e) {
            //@tddo logger
            $response['status']  = -1;
            $response['message'] = $e->getMessage();
        }
        return response()->json($response, 200);
    }

}
