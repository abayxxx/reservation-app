<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Jawaban;
use App\Models\Responden;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;


class RespondenController extends Controller
{
    //

    public function index(Request $request)
    {

        if ($request->ajax()) {
            if ($request->has('filter_bulan') && $request->filter_bulan != 0) {
                $data = Responden::query()->whereMonth('created_at', $request->filter_bulan)->get();
            } else {
                $data = Responden::query()->get();
            }

            return DataTables::of($data)
                ->addColumn('action', function ($data) {
                    $button = '&nbsp;&nbsp;&nbsp;<button type="button" id="' . $data->id . '" class="delete btn btn-mini btn-danger shadow-sm">Delete</button>';
                    return $button;
                })
                ->addColumn('jawaban', function ($data) {
                    $button = '&nbsp;&nbsp;&nbsp;<button type="button" id="' . $data->id . '" class="jawaban btn btn-mini btn-primary shadow-sm">Lihat</button>';
                    return $button;
                })
                ->addIndexColumn()
                ->rawColumns(['action', 'jawaban'])
                ->make(true);
        }

        return view('admin.responden.responden');
    }


    public function destroy($id)
    {
        try {
            $pertanyaan = Responden::find($id);
            $pertanyaan->delete();
        } catch (\Throwable $th) {
            throw $th;
        }

        return response()
            ->json([
                'success' => 'Data berhasil dihapus.',
            ]);
    }


    public function jawaban(Request $request)
    {
        $data = Jawaban::with('pertanyaan')->where('responden_id', $request->responden_id)->get();
        return response()
            ->json([
                'data' => $data,
            ]);
    }
}
