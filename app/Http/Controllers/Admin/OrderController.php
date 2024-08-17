<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
use App\Models\Menu;
use App\Models\Order;
use App\Models\Table;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class OrderController extends Controller
{
    //
    public function index(Request $request)
    {
        $tables = Table::where('status', '1')->get();
        $menus = Menu::all();

        if ($request->ajax()) {
            $data = Order::query()->get();

            return DataTables::of($data)
                ->addColumn('action', function ($data) {
                    $button = '<button type="button" id="' . $data->id . '" class="detail btn btn-mini btn-info shadow-sm">Detail</button>';
                    $button .= '&nbsp;&nbsp;&nbsp;<button type="button" id="' . $data->id . '" class="print btn btn-mini btn-primary shadow-sm">Print</button>';
                    $button .= '&nbsp;&nbsp;&nbsp;<button type="button" id="' . $data->id . '" class="delete btn btn-mini btn-danger shadow-sm">Delete</button>';

                    return $button;
                })
                ->addColumn('created_at', function ($data) {
                    return $data->created_at->format('Y-m-d H:i:s');
                })
                ->addColumn('total', function ($data) {
                    return 'Rp. ' . number_format($data->total, 0, ',', '.');
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }
        return view('admin.order.order', compact('tables', 'menus'));
    }

    public function find($id)
    {
        try {
            $order = Order::query()->with(['table', 'menu'])->where('id', $id)->first();
            $order->created_at = $order->created_at->format('Y-m-d H:i:s');
            return $order;
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'User gagal diambil.');
        }
    }

    public function store(OrderRequest $request)
    {
        //store Reservation to db
        try {
            $validated = $request->validated();

            $menu = Menu::where('id', $validated['menu_id'])->first();

            $validated['total'] = $menu->price * $validated['quantity'];
            Order::create($validated);
        } catch (\Throwable $th) {
            throw $th;
        }

        return response()
            ->json([
                'success' => 'Data berhasil ditambahkan.',
            ]);
    }

    public function destroy($id)
    {
        try {
            $order = Order::query()->where('id', $id)->first();
            $order->delete();
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function printOrder($id)
    {
        try {
            // Fetch the data you need to display in the PDF
            $data = Order::find($id);

            $data['created_at'] = $data->created_at->format('Y-m-d H:i:s');
            $data['total'] = 'Rp. ' . number_format($data->total, 0, ',', '.');
            $data['price'] = 'Rp. ' . number_format($data->menu->price, 0, ',', '.');

            // Load a view and pass the data to it
            $pdf = FacadePdf::loadView('admin.order.print', compact('data'));

            // Return the generated PDF
            return $pdf->stream('detail_transaksi.pdf');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'User gagal diambil.');
        }
    }


    public function storeOrder(Request $request)
    {
        try {
            $validated = $request->validate([
                'table_id' => 'required',
                'menu_id' => 'required',
                'quantity' => 'required',
                'name' => 'required',
            ]);

            $menu = Menu::where('id', $validated['menu_id'])->first();

            $validated['total'] = $menu->price * $validated['quantity'];
            Order::create($validated);

            return response()
                ->json([
                    'success' => 'Data berhasil ditambahkan.',
                ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
