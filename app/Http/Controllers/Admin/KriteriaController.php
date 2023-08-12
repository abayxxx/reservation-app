<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\KriteriaRequest;
use App\Models\Kriteria;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class KriteriaController extends Controller
{
    //
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Kriteria::query()->get();

            return DataTables::of($data)
                ->addColumn('action', function ($data) {
                    $button = '<button type="button" id="' . $data->id . '" class="edit btn btn-mini btn-primary shadow-sm">Edit</button>';
                    $button .= '&nbsp;&nbsp;&nbsp;<button type="button" id="' . $data->id . '" class="delete btn btn-mini btn-danger shadow-sm">Delete</button>';
                    return $button;
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }
        return view('admin.kriteria.kriteria');
    }

    public function store(KriteriaRequest $request)
    {
        //store kriteria to db
        try {
            $validated = $request->validated();
            Kriteria::create($validated);
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
            $kriteria = Kriteria::query()->where('id', $id)->first();
            return $kriteria;
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'User gagal diambil.');
        }
    }

    public function update(KriteriaRequest $request, $id)
    {

        try {
            $validated = $request->validated();
            $kriteria = Kriteria::findOrFail($id);
            $kriteria->fill($validated);
            $kriteria->update();
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
            $kriteria = Kriteria::query()->where('id', $id)->first();
            $kriteria->delete();
        } catch (\Exception $e) {
            throw $e;
        }
    }
}
