<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MenuRequest;
use App\Models\Menu;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class MenuController extends Controller
{
    //
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Menu::query()->get();

            return DataTables::of($data)
                ->addColumn('action', function ($data) {
                    $button = '<button type="button" id="' . $data->id . '" class="edit btn btn-mini btn-primary shadow-sm">Edit</button>';
                    $button .= '&nbsp;&nbsp;&nbsp;<button type="button" id="' . $data->id . '" class="delete btn btn-mini btn-danger shadow-sm">Delete</button>';
                    return $button;
                })
                ->addColumn('image', function ($data) {
                    $path = asset($data->image);
                    return '<img src="' . $path . '" class="img-thumbnail" width="100" />';
                })
                ->rawColumns(['action', 'image'])
                ->addIndexColumn()
                ->make(true);
        }
        return view('admin.menu.menu');
    }

    public function store(MenuRequest $request)
    {
        //store Menu to db
        try {

            $validated = $request->validated();

            if ($request->file()) {
                $fileName = time() . '_' . $request->image->getClientOriginalName();
                $filePath = $request->file('image')->storeAs('uploads', $fileName, 'public');

                $validated['image'] = '/storage/' . $filePath;
            }

            Menu::create($validated);
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
            $menu = Menu::query()->where('id', $id)->first();
            return $menu;
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'User gagal diambil.');
        }
    }

    public function update(MenuRequest $request, $id)
    {

        try {

            $validated = $request->validated();


            if ($request->file()) {
                $fileName = time() . '_' . $request->image->getClientOriginalName();
                $filePath = $request->file('image')->storeAs('uploads', $fileName, 'public');

                $validated['image'] = '/storage/' . $filePath;
            }

            $menu = Menu::findOrFail($id);
            $menu->fill($validated);
            $menu->update();
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

        //destroy file from st

        try {
            $menu = Menu::query()->where('id', $id)->first();

            //delete file from storage
            $image = $menu->image;
            $image = str_replace('/storage/', '', $image);
            \Storage::disk('public')->delete($image);

            $menu->delete();
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function getAll(Request $request)
    {
        try {
            $response = Menu::query();


            $response = $response->filter($request->all())->get();

            return response()
                ->json([
                    'data' => $response,
                ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function menuGuest(Request $request)
    {
        try {
            $response = Menu::query();

            $response = $response->get();


            return view('menu', compact('response'));
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function menuGuestDetail($id)
    {
        try {
            $menu = Menu::query()->where('id', $id)->first();

            return view('detail-menu', compact('menu'));
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
