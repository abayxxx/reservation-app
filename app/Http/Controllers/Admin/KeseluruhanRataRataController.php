<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Jawaban;
use Illuminate\Http\Request;

class KeseluruhanRataRataController extends Controller
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

            if (count($totalMp) != 0 || count($totalMi) != 0) {
                $sumX = array_sum($totalMp) / count($totalMp);
                $sumY = array_sum($totalMi) / count($totalMi);
            } else {
                $sumX = 0;
                $sumY = 0;
            }


            //return 
            return response()->json([
                'sumX' => round($sumX, 2),
                'sumY' => round($sumY, 2),
            ]);
        }

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

        if (count($totalMp) != 0 || count($totalMi) != 0) {
            $sumX = array_sum($totalMp) / count($totalMp);
            $sumY = array_sum($totalMi) / count($totalMi);
        } else {
            $sumX = 0;
            $sumY = 0;
        }

        $sumX = round($sumX, 2);
        $sumY = round($sumY, 2);


        return view('admin.ipa.keseluruhan-rata-rata', compact('sumX', 'sumY'));
    }
}
