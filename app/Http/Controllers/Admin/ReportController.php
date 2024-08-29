<?php

namespace App\Http\Controllers\Admin;

use App\Exports\ReportExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\ReportRequest;
use App\Models\Menu;
use App\Models\Order;
use App\Models\Table;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Barryvdh\DomPDF\PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\DataTables;

class ReportController extends Controller
{
    //
    public function index(Request $request)
    {
        $tables = Table::where('status', '1')->get();
        $menus = Menu::all();

        if ($request->ajax()) {

            $query = Order::query();



            if ($request->start_date && $request->end_date) {
                $startDate = Carbon::parse($request->start_date)->startOfDay();
                $endDate = Carbon::parse($request->end_date)->endOfDay();

                $query->whereBetween('created_at', [$startDate, $endDate]);
            }

            return DataTables::of($query->get())
                ->addColumn('created_at', function ($data) {
                    return $data->created_at->format('Y-m-d H:i:s');
                })
                ->addColumn('total', function ($data) {
                    return 'Rp. ' . number_format($data->total, 0, ',', '.');
                })
                ->addIndexColumn()
                ->make(true);
        }
        return view('admin.report.report', compact('tables', 'menus'));
    }

    public function printReport()
    {
        try {
            // Fetch the data you need to display in the PDF
            $datas = Order::query()->with(['table', 'jurnalOrder', 'jurnalOrder.menu'])->get();

            foreach ($datas as $key => $value) {
                $data[$key]['created_at'] = $value->created_at->format('Y-m-d H:i:s');
                $data[$key]['total'] = 'Rp. ' . number_format($value->total, 0, ',', '.');

                foreach ($value->jurnalOrder as $k => $v) {
                    $data[$key]['jurnalOrder'][$k]['menu']['price'] = 'Rp. ' . number_format($v->total, 0, ',', '.');
                }
            }

            // Load a view and pass the data to it
            $pdf = FacadePdf::loadView('admin.report.print', compact('datas'));

            // Return the generated PDF
            return $pdf->stream('laporan_transaksi.pdf');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'User gagal diambil.');
        }
    }

    public function excelReport()
    {
        return Excel::download(new ReportExport, 'laporan_transaksi.xlsx');
    }

    public function csvReport()
    {
        return Excel::download(new ReportExport, 'laporan_transaksi.csv');
    }
}
