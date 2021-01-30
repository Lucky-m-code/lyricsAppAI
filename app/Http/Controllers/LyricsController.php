<?php

namespace App\Http\Controllers;

use App\Http\Resources\LoginResource;
use App\Http\Resources\LyricsResource;
use App\Models\Lyrics;
use Illuminate\Http\Request;

class LyricsController extends Controller
{


    public function index()
    {
        return LyricsResource::collection(Lyrics::all());
    }


    public function store(Request $request)
    {
        $this->validate($request,[
            'music_name'=>'required',
            'artist_name'=>'required',
            'lyrics'=>'required',
        ]);

        $lyrics = Lyrics::create([
            'user_id' =>$request->user()->id,
            'music_name' => $request['music_name'],
            'artist_name' => $request['artist_name'],
            'lyrics' => $request['lyrics'],
            'url' => $request['url'],
            'status' => true

        ]);

        return new LyricsResource($lyrics);



    }

    //Display the specified resource.
    public function show(Lyrics $lyrics)
    {
        return new LyricsResource($lyrics);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
