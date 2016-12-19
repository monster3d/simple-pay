<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RateModel;
use App\Repositories\RateRepository;
class RateController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //void
    }

    public function add(Request $request)
    {
        $response = [
            'status' => 0
        ];

        $rateModel      = new RateModel($request->all());
        $rateRepository = new RateRepository();
        try {
            $rateRepository->add($rateModel);
        } catch (PDOException $e) {
            //@todo logger
        } catch (Exception $e) {
            //@todo logger
            $response['status'] = -1;
        }
        return response()->json($response, 201);
    }

    //
}
