<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Utiils\RecomHelper;
use Laracombee;

class RegisterController extends Controller
{
    protected function register(Request $request)
    {
        //validation
        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'password' => 'required|confirmed',

        ]);



        $newUser = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);



        //sign the user
        if (!auth()->attempt($request->only('email', 'password'))) {
            return response()->json(['msg' => 'Invalid credentials'], 401);
        }



        $user = $request->user();
        $token = $user->createToken('auth_token')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];
       // $user = User::findOrFail($response['id']);
       $recomHelper = RecomHelper::getInstance();
       $recommendations = $recomHelper->addUser($user);
        // $addUser = Laracombee::addUser($user);

        // Laracombee::send($addUser)->then(function () {
        //     // Success.
        // })->otherWise(function ($error) {
        //     // Handle Exeption.
        // })->wait();

        return response()->json(['status_code' => 201, 'response' => $response]);
    }
}
