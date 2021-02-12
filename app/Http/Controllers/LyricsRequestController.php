<?php

namespace App\Http\Controllers;

use App\Http\Resources\LyricsRequestResource;
use App\Http\Resources\LyricsResource;
use App\Models\Lyrics;
use Illuminate\Http\Request;

class LyricsRequestController extends Controller
{
    public function index()
    {
        return LyricsRequestResource::collection(Lyrics::all());
    }


    public function store(Request $request)
    {
        $this->validate($request,[
            'music_name'=>'required',
            'artist_name'=>'required',
            'lyrics'=>'required',
        ]);

        $user = $request->user()->id;

        $lyrics = Lyrics::create([
            'music_name' => $request['music_name'],
            'artist_name' => $request['artist_name'],
            'lyrics' => $request['lyrics'],
            'url' => $request['url'],
            'status' => true,
            'user_id' =>$user,

        ]);


        $response = [
            'lyrics' => $lyrics,
            //'user name' => $request->user()->name

        ];

        return response()->json(['status_code'=>400,'response'=>$response]);

//        return new LyricsResource($lyrics);

    }
}
