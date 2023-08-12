<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Jawaban;
use App\Models\Pertanyaan;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;


class RataRataController extends Controller
{
    //

    public function index(Request $request)
    {

        $pertanyaan = Jawaban::with('pertanyaan')->orderBy('pertanyaan_id', 'asc')->get()->groupBy('pertanyaan_id');
        $responden = Jawaban::with('responden')->orderBy('responden_id', 'asc')->get()->groupBy('responden_id')->count();


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
        if ($request->ajax()) {
            if ($request->has('filter_bulan') && $request->filter_bulan != 0) {
                $pertanyaan = Jawaban::with('pertanyaan')->whereMonth('created_at', $request->filter_bulan)->orderBy('pertanyaan_id', 'asc')->get()->groupBy('pertanyaan_id');
                $responden = Jawaban::with('responden')->whereMonth('created_at', $request->filter_bulan)->orderBy('responden_id', 'asc')->get()->groupBy('responden_id')->count();
            } else {
                $pertanyaan = Jawaban::with('pertanyaan')->orderBy('pertanyaan_id', 'asc')->get()->groupBy('pertanyaan_id');
                $responden = Jawaban::with('responden')->orderBy('responden_id', 'asc')->get()->groupBy('responden_id')->count();
            }


            // dd($pertanyaan);
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
            $pertanyaanId = [];
            foreach ($Mp as $key => $value) {
                # code...
                $pertanyaanId[] = $key;
            }

            $sumX = array_sum($totalMp);
            $sumY = array_sum($totalMi);

            $data = Pertanyaan::whereIn('id', $pertanyaanId)->get();

            $data->map(function ($item, $key) use ($totalMi, $totalMp) {
                $item->rata_rata_x = round($totalMp[$item->id], 2);
                $item->rata_rata_y = round($totalMi[$item->id], 2);
                return $item;
            });

            return DataTables::of($data)

                ->addIndexColumn()
                ->make(true);
        }

        $sumX = round(array_sum($totalMp), 2);
        $sumY = round(array_sum($totalMi), 2);

        return view('admin.ipa.rata-rata', compact('sumX', 'sumY'));
    }


    public function total(Request $request)
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

            //return 
            return response()->json([
                'sumX' => round(array_sum($totalMp), 2),
                'sumY' => round(array_sum($totalMi), 2),
            ]);
        }
    }
}
