<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Jawaban;
use App\Models\Pertanyaan;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;


class TingkatKesesuaianController extends Controller
{
    //

    public function index(Request $request)
    {
        if ($request->ajax()) {

            if ($request->has('filter_bulan') && $request->filter_bulan != 0) {
                $pertanyaan = Jawaban::with('pertanyaan')->whereMonth('created_at', $request->filter_bulan)->orderBy('pertanyaan_id', 'asc')->get()->groupBy('pertanyaan_id');
                $responden = Jawaban::with('responden')->whereMonth('created_at', $request->filter_bulan)->orderBy('responden_id', 'asc')->get()->groupBy('responden_id')->count();
            } else {
                $pertanyaan = Jawaban::with('pertanyaan')->orderBy('pertanyaan_id', 'asc')->get()->groupBy('pertanyaan_id');
                $responden = Jawaban::with('responden')->orderBy('responden_id', 'asc')->get()->groupBy('responden_id')->count();
            }


            $Mp = [];
            $Mi = [];

            foreach ($pertanyaan as $key => $value) {
                # code...
                foreach ($value as $key2 => $value2) {
                    # code...
                    //push
                    $Mp[$key][] = $value2->jawaban_pertama;
                    $Mi[$key][] = $value2->jawaban_kedua;
                }
            }

            $totalMp = [];
            $totalMi = [];

            foreach ($Mp as $key => $value) {
                # code...
                $totalMp[$key] = array_sum($value) / $responden;
            }

            foreach ($Mi as $key => $value) {
                # code...
                $totalMi[$key] = array_sum($value) / $responden;
            }

            $total = [];
            // $Gs = [];
            foreach ($totalMp as $key => $value) {

                $total[$key] = ($value / ($totalMi[$key] ?? 0)) * 100;
                // $Gs[$key] = $value - ($totalMi[$key] ?? 0);
            }
            $resultNilai = [];
            $pertanyaanId = [];
            foreach ($total as $key => $value) {
                # code...
                $resultNilai[] = $value;
                $pertanyaanId[] = $key;
            }

            $data = Pertanyaan::whereIn('id', $pertanyaanId)->get();

            $data->map(function ($item, $key) use ($resultNilai) {
                $item->nilai = round($resultNilai[$key], 2);
                return $item;
            });
            return DataTables::of($data)

                ->addIndexColumn()
                ->make(true);
        }



        return view('admin.ipa.tingkat-kesesuaian');
    }
}
