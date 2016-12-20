<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\ReportRepository;
use \SplFileObject;
use \Exception;
use \PDOException;

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
    public function report(Request $request, $format)
    {
        $reportRepository = new ReportRepository();
        
        try {
            $result = $reportRepository->all();
        } catch (PDOException $e) {
            //@todo logger
        } catch (Exception $e) {
            //@todo logger
        }

        $this->isFound($result);

        if ($format === 'csv') {
            return $this->toCsv($result);
        }

        $total = $this->getTotalActions($result); 
        
        return view('report', [
            'data'     => $result, 
            'total'    => $total,
            'redirect' => $this->getRedirectUrl($request, 'csv')
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
    public function reportByName(Request $request, $name, $format)
    {
        $reportRepository = new ReportRepository();
        
        try {
           $result = $reportRepository->byName($name);
        } catch (PDOException $e) {
            //@todo logger 
        } catch (Exception $e) {
            //@todo logger
        }

        $this->isFound($result);
        
        if ($format === 'csv') {
            return $this->toCsv($result);
        }        

        $total = $this->getTotalActions($result); 
        
        return view('report', [
            'data'     => $result, 
            'total'    => $total,
            'redirect' => $this->getRedirectUrl($request, 'csv')
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
    public function reportByDateFrom(Request $request, $name, $dataFrom, $format)
    {
        $reportRepository = new ReportRepository();
        
        try {
           $result = $reportRepository->byDateFrom($name, $dataFrom);
        } catch (PDOException $e) {
            //@todo logger 
        } catch (Exception $e) {
            //@todo logger
        }
        
        $this->isFound($result);
        
        if ($format === 'csv') {
            return $this->toCsv($result);
        }        

        $total = $this->getTotalActions($result); 
        
        return view('report', [
            'data'     => $result, 
            'total'    => $total,
            'redirect' => $this->getRedirectUrl($request, 'csv')
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
    public function reportByDateTo(Request $request, $name, $dataTo, $format)
    {
        $reportRepository = new ReportRepository();
        
        try {
           $result = $reportRepository->byDateTo($name, $dataTo);
        } catch (PDOException $e) {
            //@todo logger 
        } catch (Exception $e) {
            //@todo logger
        }

        $this->isFound($result);

        if ($format === 'csv') {
            return $this->toCsv($result);
        }    

        $total = $this->getTotalActions($result); 
        
        return view('report', [
            'data'     => $result, 
            'total'    => $total,
            'redirect' => $this->getRedirectUrl($request, 'csv') 
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
    public function reportByBetweenDate(Request $request, $name, $dateFrom, $dateTo, $format)
    {
        $reportRepository = new ReportRepository();
        
        try {
           $result = $reportRepository->byBetweenDate($name, $dateFrom, $dateTo);
        } catch (PDOException $e) {
            //@todo logger 
        } catch (Exception $e) {
            //@todo logger
        }

        $this->isFound($result);

        if ($format === 'csv') {
            return $this->toCsv($result);
        }   

        $total = $this->getTotalActions($result); 
        
        return view('report', [
            'data'     => $result, 
            'total'    => $total,
            'redirect' => $this->getRedirectUrl($request, 'csv') 
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
        $totalSubtraction     = [];
        $totalAddition        = []; 
        $totalCursAddition    = [];
        $totalCursSubtraction = [];
        
        foreach ($result as $value) {
            if ($value['action'] === 'addition') {
                array_unshift($totalAddition, $value['sum_value']);
                array_unshift($totalCursAddition, $value['curs']);
            }
            if ($value['action'] === 'subtraction') {
                array_unshift($totalSubtraction, $value['sum_value']);
                array_unshift($totalCursSubtraction, $value['curs']);
            }
        }
        return [
            'addition'         => array_sum($totalAddition), 
            'subtraction'      => array_sum($totalSubtraction),
            'curs_subtraction' => array_sum($totalCursSubtraction),
            'curs_addition'    => array_sum($totalCursAddition)
       ];
    }

    /**
    *
    * Prepare and send csv file
    *
    * @param $data array
    *
    */
    public function toCsv(array $data)
    {
        $fileName = sprintf('%s.csv', date('m_d_y_H_i', time())); 
        $csvPath  = sprintf("%s/app/%s", storage_path(), $fileName);
        $resource = new SplFileObject($csvPath, 'w');

        foreach($data as $value) {
            $resource->fputcsv($value);
        }

        $headers = [
            'Content-Type'        => 'text/csv',
            'Content-Disposition' => sprintf('attachment; filename=%s', $fileName),
            'Expires'             => 0
        ];
        return response()->download($csvPath, $fileName, $headers);
    }

    /**
    *
    * Get report url by format
    *
    */
    public function getRedirectUrl(Request $request, $to)
    {
        return sprintf('%s/%s', $request->url(), $to);
    }

    /**
    *
    * @todo implements ability response more one format
    */
    public function checkFormat($format)
    {
        switch ($format) {
            case 'csv':
            break;

            case 'xml':
            break;
        }
    }
}
