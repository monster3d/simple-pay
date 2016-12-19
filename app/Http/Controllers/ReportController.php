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

    /**
    *
    * Get all reports for all clients 
    *
    * @param $request Illuminate\Http\Request
    *
    * @return array
    *
    */
    public function report(Request $request)
    {
        $reportRepository = new ReportRepository();
        
        try {
            $result = $reportRepository->all();
        } catch (PDOException $e) {
            //@todo logger
        } catch (Exception $e) {
            //@todo logger
        }

        $total = $this->getTotalActions($result); 
        
        return view('report', [
            'data'        => $result, 
            'addition'    => $total['addition'], 
            'subtraction' => $total['subtraction']
            ]);
    }

    /**
    *
    * Get all report by name
    *
    * @param $request Illuminate\Http\Request
    * @param $name string
    *
    * @return array 
    *
    */
    public function reportByName(Request $request, $name)
    {
        $reportRepository = new ReportRepository();
        
        try {
           $result = $reportRepository->byName($name);
        } catch (PDOException $e) {
            //@todo logger 
        } catch (Exception $e) {
            //@todo logger
        }

        if (count($result) === 0 ) {
            abort(404);
        }

        $total = $this->getTotalActions($result); 
        
        return view('report', [
            'data'        => $result, 
            'addition'    => $total['addition'], 
            'subtraction' => $total['subtraction']
            ]);
    } 

    /**
    *
    * Get report by name and data from
    *
    * @param $request Illuminate\Http\Request
    * @param $name string
    * @param $dataFrom string
    *
    */
    public function reportByDateFrom(Request $request, $name, $dataFrom)
    {
        $reportRepository = new ReportRepository();
        
        try {
           $result = $reportRepository->byDateFrom($name, $dataFrom);
        } catch (PDOException $e) {
            //@todo logger 
        } catch (Exception $e) {
            //@todo logger
        }

        if (count($result) === 0 ) {
            abort(404);
        }

        $total = $this->getTotalActions($result); 
        
        return view('report', [
            'data'        => $result, 
            'addition'    => $total['addition'], 
            'subtraction' => $total['subtraction']
            ]);
    } 

   /**
    *
    * Get report by name and data to
    *
    * @param $request Illuminate\Http\Request
    * @param $name string
    * @param $dataTo string
    *
    */
    public function reportByDateTo(Request $request, $name, $dataTo)
    {
        $reportRepository = new ReportRepository();
        
        try {
           $result = $reportRepository->byDateTo($name, $dataTo);
        } catch (PDOException $e) {
            //@todo logger 
        } catch (Exception $e) {
            //@todo logger
        }

        if (count($result) === 0 ) {
            abort(404);
        }

        $total = $this->getTotalActions($result); 
        
        return view('report', [
            'data'        => $result, 
            'addition'    => $total['addition'], 
            'subtraction' => $total['subtraction']
            ]);
    }

    /**
    *
    * Get report by name and data to
    *
    * @param $request Illuminate\Http\Request
    * @param $name string
    * @param $dateFrom string
    * @param $dateTo string
    *
    */
    public function reportByBetweenDate(Request $request, $name, $dateFrom, $dateTo)
    {
        $reportRepository = new ReportRepository();
        
        try {
           $result = $reportRepository->byBetweenDate($name, $dateFrom, $dateTo);
        } catch (PDOException $e) {
            //@todo logger 
        } catch (Exception $e) {
            //@todo logger
        }

        if (count($result) === 0 ) {
            abort(404);
        }

        $total = $this->getTotalActions($result); 
        
        return view('report', [
            'data'        => $result, 
            'addition'    => $total['addition'], 
            'subtraction' => $total['subtraction']
            ]);
    }  

    /**
    *
    * Get total action
    *
    * @param $result array
    *
    * @return array
    *
    */
    public function getTotalActions($result)
    {
        $totalSubtraction = [];
        $totalAddition    = []; 

        foreach ($result as $value) {
            if ($value['action'] === 'addition') {
                array_unshift($totalAddition, $value['value']);
            }
            if ($value['action'] === 'subtraction') {
                array_unshift($totalSubtraction, $value['value']);
            }
            return ['addition' => array_sum($totalAddition), 'subtraction' => array_sum($totalSubtraction)];
        }
    }
}
