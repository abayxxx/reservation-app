<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Jawaban;
use App\Models\Pertanyaan;
use Illuminate\Http\Request;

class ChartController extends Controller
{
    //

    public function index(Request $request)
    {
        // if ($request->ajax()) {
        // }
        $pertanyaan = Jawaban::with('pertanyaan')->orderBy('pertanyaan_id', 'asc')->get()->groupBy('pertanyaan_id');
        $responden = Jawaban::with('responden')->orderBy('responden_id', 'asc')->get()->groupBy('responden_id')->count();



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

        foreach ($totalMp as $key => $value) {

            $pertanyaanId[] = $key;
        }


        $data = Pertanyaan::whereIn('id', $pertanyaanId)->get();
        $data->map(function ($item, $key) use ($totalMp, $totalMi) {
            $item->rata_rata_mp = $totalMp[$item->id];
            $item->rata_rata_mi = $totalMi[$item->id];

            if ($item->rata_rata_mp < 3 && $item->rata_rata_mi >= 3) {
                $item->kuadran = 'Kuadran I';
            } elseif ($item->rata_rata_mp >= 3 && $item->rata_rata_mi >= 3) {
                $item->kuadran = 'Kuadran II';
            } elseif ($item->rata_rata_mp < 3 && $item->rata_rata_mi < 3) {
                $item->kuadran = 'Kuadran III';
            } elseif ($item->rata_rata_mp >= 3 && $item->rata_rata_mi < 3) {
                $item->kuadran = 'Kuadran IV';
            } else {
                $item->kuadran = 'Kuadran Belum Terdefinisi';
            }

            unset($item->created_at, $item->updated_at, $item->id, $item->pertanyaan, $item->kriteria_id, $item->kode_atribut);
        });

        //extract kuadran

        $kuadranI = [];
        $kuadranII = [];
        $kuadranIII = [];
        $kuadranIV = [];

        foreach ($data as $key => $value) {
            # code...
            $tempData = [];
            $tempData[] = round($value->rata_rata_mp, 1);
            $tempData[] = round($value->rata_rata_mi, 1);
            $tempData[] = 10;

            if ($value->kuadran == 'Kuadran I') {
                $kuadranI[] = $tempData;
            } elseif ($value->kuadran == 'Kuadran II') {
                $kuadranII[] = $tempData;
            } elseif ($value->kuadran == 'Kuadran III') {
                $kuadranIII[] = $tempData;
            } elseif ($value->kuadran == 'Kuadran IV') {
                $kuadranIV[] = $tempData;
            }
        }

        return view('admin.ipa.chart', compact('data', 'kuadranI', 'kuadranII', 'kuadranIII', 'kuadranIV'));
    }


    public function filterMonth(Request $request)
    {
        if ($request->has('month') && $request->month != 0) {
            $pertanyaan = Jawaban::with('pertanyaan')->whereMonth('created_at', $request->month)->orderBy('pertanyaan_id', 'asc')->get()->groupBy('pertanyaan_id');
            $responden = Jawaban::with('responden')->whereMonth('created_at', $request->month)->orderBy('responden_id', 'asc')->get()->groupBy('responden_id')->count();
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

        foreach ($totalMp as $key => $value) {

            $pertanyaanId[] = $key;
        }


        $data = Pertanyaan::whereIn('id', $pertanyaanId)->get();
        $data->map(function ($item, $key) use ($totalMp, $totalMi) {
            $item->rata_rata_mp = $totalMp[$item->id];
            $item->rata_rata_mi = $totalMi[$item->id];

            if ($item->rata_rata_mp < 3 && $item->rata_rata_mi >= 3) {
                $item->kuadran = 'Kuadran I';
            } elseif ($item->rata_rata_mp >= 3 && $item->rata_rata_mi >= 3) {
                $item->kuadran = 'Kuadran II';
            } elseif ($item->rata_rata_mp < 3 && $item->rata_rata_mi < 3) {
                $item->kuadran = 'Kuadran III';
            } elseif ($item->rata_rata_mp >= 3 && $item->rata_rata_mi < 3) {
                $item->kuadran = 'Kuadran IV';
            } else {
                $item->kuadran = 'Kuadran Belum Terdefinisi';
            }

            unset($item->created_at, $item->updated_at, $item->id, $item->pertanyaan, $item->kriteria_id, $item->kode_atribut);
        });

        $kuadranI = [];
        $kuadranII = [];
        $kuadranIII = [];
        $kuadranIV = [];

        foreach ($data as $key => $value) {
            # code...
            $tempData = [];
            $tempData[] = round($value->rata_rata_mp, 1);
            $tempData[] = round($value->rata_rata_mi, 1);
            $tempData[] = 10;

            if ($value->kuadran == 'Kuadran I') {
                $kuadranI[] = $tempData;
            } elseif ($value->kuadran == 'Kuadran II') {
                $kuadranII[] = $tempData;
            } elseif ($value->kuadran == 'Kuadran III') {
                $kuadranIII[] = $tempData;
            } elseif ($value->kuadran == 'Kuadran IV') {
                $kuadranIV[] = $tempData;
            }
        }

        return response()->json([
            'data' => $data,
            'kuadranI' => $kuadranI,
            'kuadranII' => $kuadranII,
            'kuadranIII' => $kuadranIII,
            'kuadranIV' => $kuadranIV,
        ]);
    }
}
