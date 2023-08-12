<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChangePasswordRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ChangePasswordController extends Controller
{
    //
    public function index()
    {
        $user = auth()->user();
        return view('auth.change-password', compact('user'));
    }

    public function store(ChangePasswordRequest $request)
    {
        $user = auth()->user();


        try {
            // if (!Hash::check($request->currentPassword, $user->password)) {
            //     return response()->json(['error' => 'Current password does not match!'], 500);
            // }
            $user->username = $request['username'];
            $user->password = bcrypt($request['renewPassword']);
            $user->save();
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
