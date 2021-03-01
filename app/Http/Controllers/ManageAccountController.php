<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ManageAccountController extends Controller
{
    public function update(Request $request, $id)
    {
        try{
            $this->validate($request,[
//                'name'=>'required',
//                'email'=>'required',
//                'password'=>'required',
            ]);
            $user = User::where('id', $id)->first();

            $response = [
                'user' => $request->user()->name,
                'user_id' => $user
            ];

            if ($request->user()->id != $user->id) {
                return response()->json(['error' => 'u can only update your profile.','response' => $response], 403);
            }

            $password = Hash::make($request['password']);
           $user->name = $request['name'];
           $user->email = $request['email'];
           $user->password = $password;

           $user->save();

            return $response;

        }catch (Exception $e){
            echo $e;
        }

    }

    public function destroy(Request $request,$id)
    {
        $user = User::where('id', $id)->first();
        if($request->user()->id != $user->id){
            return response()->json(['error' => 'You can only delete your own profile.'], 403);
        }
        $user ->delete();

        return response()->json(['msg' => 'user deleted'],200);
    }
}
