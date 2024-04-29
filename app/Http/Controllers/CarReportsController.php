<?php

namespace App\Http\Controllers;

use App\Models\Clients;
use App\Models\Vendors;
use App\Models\Car_Reports;
use App\Models\carInoutTime;
use App\Models\Reporting;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Carbon;
// use PhpOffice\PhpSpreadsheet\Writer\Xls;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class CarReportsController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $clients = Clients::all();
        $vendors = Vendors::all();
        $orders = carInoutTime::with('clients', 'vehical')->get();
        return view('admin.report.index', compact('clients', 'vendors', 'orders'));
    }
    public function searching(Request $request)
    {
        // dd($request->all());
        $vehicles_id = $request->vehicle_id;
        $clients_id = $request->client_id;
        $fromDate = $request->fromDate;
        $toDate = $request->toDate;
        // $start_time = $request->startTime;
        // $end_time = $request->endTime;
        // dd( $request->all());
        $orders = carInoutTime::when($vehicles_id, function ($q) use ($vehicles_id) {
            return $q->where('vehicles_id', $vehicles_id);
        })->when($clients_id, function ($q) use ($clients_id) {
            return $q->where('clients_id', $clients_id);
        })
            ->when($fromDate, function ($q) use ($fromDate) {
                return $q->whereDate('car_date', '>=', $fromDate);
            })
            ->when($toDate, function ($q) use ($toDate) {
                return $q->whereDate('car_date', '<=', $toDate);
            })
            // ->when($start_time, function ($q) use ($start_time) {
            //     return $q->whereDate('in_time', '<=', $start_time);
            // })
            // ->when($end_time, function ($q) use ($end_time) {
            //     return $q->whereDate('out_time', '<=', $end_time);
            // })
            ->get();
        return view("admin.report.report", compact("orders"))->render();
    }
    public function exportData(Request $request, $type)
    {
        // dd($request->all());
        $id = $request->orderId;
        $carReports = carInoutTime::with('clients', 'vehical')->whereIn('id', $id)->get();
        // dd( $carReports);
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'Id');
        $sheet->setCellValue('B1', 'Vehicle Type');
        $sheet->setCellValue('C1', 'Client Name');
        $sheet->setCellValue('E1', 'car_date');
        $sheet->setCellValue('F1', 'Car In Time');
        $sheet->setCellValue('G1', 'Car Out Time');
        $rows = 2;
        foreach ($carReports as $carReport) {
            $sheet->setCellValue('A' . $rows, $carReport['id']);
            $sheet->setCellValue('B' . $rows, $carReport['vehical']['car_number']);
            $sheet->setCellValue('C' . $rows, $carReport['clients']['name']);
            $sheet->setCellValue('D' . $rows, $carReport['car_date']);
            $sheet->setCellValue('E' . $rows, $carReport['in_time']);
            $sheet->setCellValue('F' . $rows, $carReport['out_time']);
            $rows++;
        }
        $fileName = "Car_report." . $type;
        if ($type == 'xlsx') {
            $writer = new Xlsx($spreadsheet);
        } else if ($type == 'xls') {
            $writer = new Xls($spreadsheet);
        }
        $writer->save(base_path() . '/public/export/' . $fileName);
        header("Content-Type: application/vnd.ms-excel");
        return redirect(url('/') . "/export/" . $fileName);
    }


    public function carIssueList(Request $request)
    {
        $datas = Reporting::with(
            'clients',
            'users',
            'formVehical',
            'toVehical'
        )->get();
        return view('admin.carReporting.issue-list', compact('datas'));
    }
}
