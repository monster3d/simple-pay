<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\ReportRepository;

class ReportController extends Controller
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

    public function report(Request $request, $uid = null, $fromData = null, $toData = null)
    {

        $fromData = $this->getDateFormat($fromData, '1990-01-01 00:00:00');
        $toData   = $this->getDateFormat($toData, '2099-01-01 00:00:00');

        $totalSubtraction = [];
        $totalAddition    = []; 
        $reportRepository = new ReportRepository();
        $result = $reportRepository->report($fromData, $toData);
        foreach ($result as $value) {
            if ($value['alias'] === 'addition') {
                array_unshift($totalAddition, $value['value']);
            }
            if ($value['alias'] === 'subtraction') {
                array_unshift($totalSubtraction, $value['value']);
            }
        }
        return view('report', [
            'data' => $result, 
            'addition' => array_sum($totalAddition), 
            'subtraction' => array_sum($totalSubtraction)]);
    }

    /**
    *
    * Get date fomat
    *
    */
    public function getDateFormat($timestamp = null, $default)
    {
        $result = $default;

        if ($timestamp !== null) {
            $result = date("Y-m-d H:i:s", $timestamp);
        }
        return $result;
    }
}
