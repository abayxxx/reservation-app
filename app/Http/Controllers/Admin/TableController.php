<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TableRequest;
use App\Models\Table;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class TableController extends Controller
{
    //
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Table::query()->get();

            return DataTables::of($data)
                ->addColumn('action', function ($data) {
                    $button = '<button type="button" id="' . $data->id . '" class="edit btn btn-mini btn-primary shadow-sm">Edit</button>';
                    $button .= '&nbsp;&nbsp;&nbsp;<button type="button" id="' . $data->id . '" class="delete btn btn-mini btn-danger shadow-sm">Delete</button>';
                    return $button;
                })
                ->addColumn('status', function ($data) {
                    if ($data->status == 1) {
                        return '<span class="badge bg-success">Tersedia</span>';
                    } else {
                        return '<span class="badge bg-danger">Tidak Tersedia</span>';
                    }
                })
                ->rawColumns(['action', 'status'])
                ->addIndexColumn()
                ->make(true);
        }
        return view('admin.table.table');
    }

    public function store(TableRequest $request)
    {
        //store Table to db
        try {
            $validated = $request->validated();
            Table::create($validated);
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
            $table = Table::query()->where('id', $id)->first();
            return $table;
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'User gagal diambil.');
        }
    }

    public function update(TableRequest $request, $id)
    {

        try {
            $validated = $request->validated();
            $table = Table::findOrFail($id);
            $table->fill($validated);
            $table->update();
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
            $table = Table::query()->where('id', $id)->first();
            $table->delete();
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function getAll(Request $request)
    {
        try {
            $tables = Table::where('status', '1')->get();

            return response()->json([
                'data' => $tables
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
