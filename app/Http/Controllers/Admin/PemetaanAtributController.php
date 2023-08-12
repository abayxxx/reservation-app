<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Jawaban;
use App\Models\Pertanyaan;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;


class PemetaanAtributController extends Controller
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


            // $Gs = [];
            $pertanyaanId = [];

            foreach ($totalMp as $key => $value) {

                // $Gs[$key] = $value - ($totalMi[$key] ?? 0);
                $pertanyaanId[] = $key;
            }


            // $resultNilai = [];
            // $resultGs = [];
            // foreach ($Gs as $key => $value) {
            //     # code...
            //     $resultNilai[] = $value / $responden;
            //     $resultGs[] = $value;
            // }

            $data = Pertanyaan::whereIn('id', $pertanyaanId)->get();
            $data->map(function ($item, $key) use ($totalMp, $totalMi) {
                $item->rata_rata_mp = $totalMp[$item->id];
                $item->rata_rata_mi = $totalMi[$item->id];
            });
            // dd($data);
            return DataTables::of($data)
                ->addColumn('pemetaan_atribut', function ($data) {

                    // switch ($data->nilai) {
                    //     case $data->rata_rata_mp >= 3 && $data->rata_rata_mi >= 3:
                    //         return 'Kuadran I';
                    //     case $data->rata_rata_mp < 3 && $data->rata_rata_mi >= 3:
                    //         return 'Kuadran II';
                    //     case $data->rata_rata_mp >= 3 && $data->rata_rata_mi < 3:
                    //         return 'Kuadran III';
                    //     case $data->rata_rata_mp < 3 && $data->rata_rata_mi < 3:
                    //         return 'Kuadran IV';
                    //         break;
                    //     default:
                    //         return 'Tidak ada Kuadaran yang sesuai';
                    //         # code...
                    //         break;
                    // }

                    //use if 
                    if ($data->rata_rata_mp < 3 && $data->rata_rata_mi >= 3) {
                        return 'Kuadran I';
                    } elseif ($data->rata_rata_mp >= 3 && $data->rata_rata_mi >= 3) {
                        return 'Kuadran II';
                    } elseif ($data->rata_rata_mp < 3 && $data->rata_rata_mi < 3) {
                        return 'Kuadran III';
                    } elseif ($data->rata_rata_mp >= 3 && $data->rata_rata_mi < 3) {
                        return 'Kuadran IV';
                    } else {
                        return 'Tidak ada Kuadaran yang sesuai';
                    }
                })
                ->addColumn('keterangan', function ($data) {
                    // switch ($data->nilai) {
                    //     case $data->nilai >= $data->rata_rata:
                    //         return 'Prioritas Utama';
                    //         break;
                    //     case $data->nilai >= 0 && $data->nilai < $data->rata_rata:
                    //         return 'Pertahankan';
                    //         break;
                    //     case $data->nilai < $data->rata_rata && $data->nilai < 0:
                    //         return 'Prioritas Rendah';
                    //         break;
                    //     case $data->nilai >= -$data->rata_rata && $data->nilai < 0:
                    //         return 'Berlebihan';
                    //         break;
                    //     default:
                    //         return 'Tidak ada Keterangan yang sesuai';
                    //         # code...
                    //         break;
                    // }

                    //use if
                    if ($data->rata_rata_mp < 3 && $data->rata_rata_mi >= 3) {
                        return 'Prioritas Utama';
                    } elseif ($data->rata_rata_mp >= 3 && $data->rata_rata_mi >= 3) {
                        return 'Pertahankan';
                    } elseif ($data->rata_rata_mp < 3 && $data->rata_rata_mi < 3) {
                        return 'Prioritas Rendah';
                    } elseif ($data->rata_rata_mp >= 3 && $data->rata_rata_mi < 3) {
                        return 'Berlebihan';
                    } else {
                        return 'Tidak ada Kuadaran yang sesuai';
                    }
                })
                ->addIndexColumn()
                ->rawColumns(['pemetaan_atribut', 'keterangan'])
                ->make(true);
        }
        return view('admin.ipa.pemetaan-atribut');
    }
}
