<?php

namespace App\Http\Controllers;

use App\Http\Resources\LoginResource;
use Illuminate\Http\Request;

class LoginController extends Controller
{

    public function login(Request $request)
    {
        //validation
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        //sign the user
        if (!auth()->attempt($request->only('email', 'password')) && $request->remember) {
            return response()->json(['msg' => 'Invalid credentials'], 401);
        }

        return new LoginResource(auth()->user());
    }

}