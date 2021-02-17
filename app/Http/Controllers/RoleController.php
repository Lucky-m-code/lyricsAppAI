<?php

namespace App\Http\Controllers;

use App\Http\Resources\LyricsResource;
use App\Http\Resources\RoleResource;
use App\Models\Lyrics;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{

    public function index()
    {
        return RoleResource::collection(Role::all());
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=>'required',
        ]);


        $role_name = Role::create([
            'name' => $request['music_name'],


        ]);


        $response = [
            'role' => $role_name,

        ];

        return response()->json(['status_code'=>400,'response'=>$response]);

//        return new RoleResource($lyrics);

    }

    //Display the specified resource.
    public function show(Role $role)
    {
        return new RoleResource($role);
    }

    //Update the specified resource in storage.
    public function update(Request $request, Role $role)
    {
        $this->validate($request,[
            'name'=>'required',

        ]);


        $response = [
            'role_name' => $role

        ];

        if (!$request->user->isAdmin) {

            return response()->json(['error' => 'only admins can edit users.','response' => $response], 403);

        }
        $role->update($request->only(['name']));
        return new RoleResource($role);

    }

    public function destroy(Request $request,Role $role)
    {
        if(!$request->user->isAdmin){
            return response()->json(['error' => 'only admins can delete role.'], 403);
        }
        $role ->delete();

        return response()->json(['msg' => 'role deleted'],200);
    }




}
