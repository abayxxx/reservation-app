<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PertanyaanRequest;
use App\Models\Kriteria;
use App\Models\Pertanyaan;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;


class PertanyaanController extends Controller
{
    //

    public function index(Request $request)
    {
        $kriteria = Kriteria::all();
        if ($request->ajax()) {
            $data = Pertanyaan::query()->get();

            return DataTables::of($data)
                ->addColumn('action', function ($data) {
                    $button = '<button type="button" id="' . $data->id . '" class="edit btn btn-mini btn-primary shadow-sm">Edit</button>';
                    $button .= '&nbsp;&nbsp;&nbsp;<button type="button" id="' . $data->id . '" class="delete btn btn-mini btn-danger shadow-sm">Delete</button>';
                    return $button;
                })
                ->addColumn('kriteria', function ($data) {
                    return $data->kriteria->kriteria;
                })
                ->rawColumns(['action', 'kriteria'])
                ->addIndexColumn()
                ->make(true);
        }
        return view('admin.pertanyaan.pertanyaan', compact('kriteria'));
    }


    public function store(PertanyaanRequest $request)
    {
        try {
            $validated = $request->validated();
            Pertanyaan::create($validated);
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
            $pertanyaan = Pertanyaan::query()->where('id', $id)->first();
            return $pertanyaan;
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'User gagal diambil.');
        }
    }

    public function update(PertanyaanRequest $request, $id)
    {
        try {
            $validated = $request->validated();
            $pertanyaan = Pertanyaan::findOrFail($id);
            $pertanyaan->fill($validated);
            $pertanyaan->update();
        } catch (\Throwable $th) {
            throw $th;
        }

        return response()
            ->json([
                'success' => 'Data berhasil diubah.',
            ]);
    }

    public function destroy($id)
    {
        try {
            $pertanyaan = Pertanyaan::find($id);
            $pertanyaan->delete();
        } catch (\Throwable $th) {
            throw $th;
        }

        return response()
            ->json([
                'success' => 'Data berhasil dihapus.',
            ]);
    }
}
