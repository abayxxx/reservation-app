<?php

namespace App\Http\Controllers\Responden;

use App\Http\Controllers\Controller;
use App\Http\Requests\SubmitRequest;
use App\Models\Pertanyaan;
use App\Models\Responden;
use Illuminate\Http\Request;

class PertanyaanController extends Controller
{
    //

    public function index()
    {
        $pertanyaan = Pertanyaan::with('kriteria')->orderBy('id', 'asc')->first();
        $count = Pertanyaan::count();
        return view('responden.responden', compact('pertanyaan', 'count'));
    }


    public function showQuestion($id, $direction = null)
    {
        // Ambil pertanyaan dari database berdasarkan id
        $pertanyaan = Pertanyaan::with('kriteria')->findOrFail($id);
        $count = Pertanyaan::count();

        if ($direction === 'prev') {
            $pertanyaanSebelumnya = Pertanyaan::with('kriteria')->where('id', '<', $id)->orderBy('id', 'desc')->first();
            $pertanyaan = $pertanyaanSebelumnya ?? $pertanyaan;
        } elseif ($direction === 'next') {
            $pertanyaanSelanjutnya = Pertanyaan::with('kriteria')->where('id', '>', $id)->orderBy('id')->first();
            $pertanyaan = $pertanyaanSelanjutnya ?? $pertanyaan;
        } else {
            $pertanyaan = $pertanyaan;
        }

        return response()->json([
            'pertanyaan' => $pertanyaan,
            'count' => $count,
        ]);
    }


    public function submitQuestion(Request $request)
    {
        // $validated = $request->validate();


        $responden = json_decode($request['responden'], true);
        $a_first = json_decode($request['a_first'], true);
        $a_second = json_decode($request['a_second'], true);

        //save data responden
        $responden = Responden::create($responden);

        //save data jawaban responden
        foreach ($a_first as $key => $value) {
            $responden->jawaban()->create([
                'pertanyaan_id' => $key,
                'responden_id' => $responden->id,
                'jawaban_pertama' => $value,
                'jawaban_kedua' => $a_second[$key],
            ]);
        }

        return response()->json([
            'success' => 'Jawaban berhasil disimpan.',
        ]);
    }
}
