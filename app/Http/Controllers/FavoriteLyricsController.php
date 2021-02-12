<?php

namespace App\Http\Controllers;

use App\Http\Resources\FavoriteLyricsResource;
use App\Http\Resources\LyricsRequestResource;
use App\Models\Favourites;
use App\Models\Lyrics;
use App\Models\LyricsRequest;
use Illuminate\Http\Request;

class FavoriteLyricsController extends Controller
{
//    public function index()
//    {
//        return FavoriteLyricsResource::collection(Favourites::all());
//    }


//    public function store(Request $request)
//    {
//        $this->validate($request,[
//            'user_id'=>'required',
//            'lyrics_id'=>'required',
//        ]);
//
//        $user = $request->user()->id;
//
//        $lyrics = FavoriteLyricsController::create([
//            'lyrics_id' => $request['something'],
//            'user_id' =>$user,
//
//        ]);
//
//
//        $response = [
//            'favoriteLyrics' => $lyrics,
//            //'user name' => $request->user()->name
//        ];
//
//        return response()->json(['status_code'=>400,'response'=>$response]);
//
////        return new LyricsResource($lyrics);
//
//    }

//    //Display the specified resource.
//    public function show(Favourites $favouriteLyrics)
//    {
//        return new FavoriteLyricsController($favouriteLyrics);
//    }



//    Update the specified resource in storage.
//    updating is not allowed for LyricsRequest
//    public function update(Request $request, Favourites $favouriteLyrics)
//    {
//        $this->validate($request,[
//            'lyrics_id'=>'required',
//            'user_id'=>'required',
//        ]);
//
//
//        $response = [
//            'user' => $request->user()->name,
//
//        ];
//
//        if ($request->user()->id !== $favouriteLyrics->user_id) {
//
//            return response()->json(['error' => 'You can only edit your own lyrics.','response' => $response], 403);
//
//        }
//        $favouriteLyrics->update($request->only(['music_name','artist_name','url']));
//        return new LyricsRequestResource($favouriteLyrics);
//
//
//    }


    //Remove the specified resource from storage.
    //The HTTP 204 No Content success status response code indicates that a request has succeeded,
    //but that the client doesn't need to navigate away from its current page
//    public function destroy(Request $request,LyricsRequest $favouriteLyrics)
//    {
//        if($request->user()->id != $favouriteLyrics->user_id){
//            return response()->json(['error' => 'You can only delete your own lyrics Request.'], 403);
//        }
//        $favouriteLyrics ->delete();
//
//        return response()->json(['msg' => 'lyrics Request deleted'],200);
//    }
}
