<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ReservationRequest;
use App\Models\Reservation;
use App\Models\Table;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;


class ReservationController extends Controller
{
    //
    public function index(Request $request)
    {

        $tables = Table::where('status', '1')->get();

        if ($request->ajax()) {
            $data = Reservation::query()->get();

            return DataTables::of($data)
                ->addColumn('action', function ($data) {
                    $button = '<button type="button" id="' . $data->id . '" class="detail btn btn-mini btn-info shadow-sm">Detail</button>';
                    $button .= '&nbsp;&nbsp;&nbsp;<button type="button" id="' . $data->id . '" class="print btn btn-mini btn-primary shadow-sm">Print</button>';
                    $button .= '&nbsp;&nbsp;&nbsp;<button type="button" id="' . $data->id . '" class="delete btn btn-mini btn-danger shadow-sm">Delete</button>';
                    return $button;
                })
                ->addColumn('table_id', function ($data) {
                    return $data->table->number;
                })
                ->addColumn('total', function ($data) {
                    return 'Rp. ' . number_format($data->total, 0, ',', '.');
                })
                ->rawColumns(['action', 'table_id'])
                ->addIndexColumn()
                ->make(true);
        }


        return view('admin.reservation.reservation', compact('tables'));
    }

    public function store(ReservationRequest $request)
    {
        //store Reservation to db
        try {
            $validated = $request->validated();

            $validated['date'] = date('Y-m-d', strtotime($request->date)) . ' ' . $request->time;
            unset($validated['time']);
            Reservation::create($validated);
        } catch (\Throwable $th) {
            throw $th;
        }

        return response()
            ->json([
                'success' => 'Data berhasil ditambahkan.',
            ]);
    }

    public function find($id)
    {
        try {
            $reservation = Reservation::query()->with('table')->where('id', $id)->first();

            $explodeDate = explode(' ', $reservation->date);
            $reservation->date = date('Y-m-d', strtotime($explodeDate[0]));
            $reservation->time = $explodeDate[1];
            $reservation->table_no = $reservation->table->number;

            return $reservation;
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'User gagal diambil.');
        }
    }

    public function update(ReservationRequest $request, $id)
    {

        try {
            $validated = $request->validated();

            $validated['date'] = date('Y-m-d', strtotime($request->date)) . ' ' . $request->time;

            //delete request time
            unset($validated['time']);
            $reservation = Reservation::findOrFail($id);
            $reservation->fill($validated);
            $reservation->update();
        } catch (\Throwable $th) {
            throw $th;
        }

        return response()
            ->json([
                'success' => 'Data berhasil diupdate.',
            ]);
    }

    public function destroy($id)
    {
        try {
            $reservation = Reservation::query()->where('id', $id)->first();
            $reservation->delete();
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function printReservation($id)
    {
        try {
            // Fetch the data you need to display in the PDF
            $data = Reservation::find($id);

            $data['total'] = 'Rp. ' . number_format($data->total, 0, ',', '.');

            // Load a view and pass the data to it
            $pdf = FacadePdf::loadView('admin.reservation.print', compact('data'));

            // Return the generated PDF
            return $pdf->stream('detail_reservasi.pdf');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'User gagal diambil.');
        }
    }
}
