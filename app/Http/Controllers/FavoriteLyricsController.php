<?php

namespace App\Http\Controllers;

use App\Http\Resources\FavoriteLyricsResource;
use App\Http\Resources\LyricsRequestResource;
use App\Models\Lyrics;
use App\Models\LyricsRequest;
use Illuminate\Http\Request;

class FavoriteLyricsController extends Controller
{
//    public function index()
//    {
//        return FavoriteLyricsResource::collection(Lyrics::all());
//    }
//
//
//    public function store(Request $request)
//    {
//        $this->validate($request,[
//            'user_id'=>'required',
//            'lyrics_id'=>'required',
//        ]);
//
//        $user = $request->user()->id;
//
//        $lyrics = LyricsRequest::create([
//            'lyrics_id' => $request['music_name'],
//            'user_id' =>$user,
//
//        ]);
//
//
//        $response = [
//            'favoriteLyrics' => $lyrics,
//            //'user name' => $request->user()->name
//
//        ];
//
//        return response()->json(['status_code'=>400,'response'=>$response]);
//
////        return new LyricsResource($lyrics);
//
//    }
//
//    //Display the specified resource.
//    public function show(LyricsRequest $lyricsRequest)
//    {
//        return new LyricsRequestResource($lyricsRequest);
//    }
//
//
//
////    Update the specified resource in storage.
////    updating is not allowed for LyricsRequest
//    public function update(Request $request, LyricsRequest $lyricsRequest)
//    {
//        $this->validate($request,[
//            'music_name'=>'required',
//            'artist_name'=>'required',
//            'url'=>'required',
//        ]);
//
//
//        $response = [
//            'user' => $request->user()->name,
//            'lyrics_user_id' => $lyricsRequest
//
//        ];
//
//        if ($request->user()->id !== $lyricsRequest->user_id) {
//
//            return response()->json(['error' => 'You can only edit your own lyrics.','response' => $response], 403);
//
//        }
//        $lyricsRequest->update($request->only(['music_name','artist_name','url']));
//        return new LyricsRequestResource($lyricsRequest);


    }


    //Remove the specified resource from storage.
    //The HTTP 204 No Content success status response code indicates that a request has succeeded,
    //but that the client doesn't need to navigate away from its current page
    public function destroy(Request $request,LyricsRequest $lyricsRequest)
    {
        if($request->user()->id != $lyricsRequest->user_id){
            return response()->json(['error' => 'You can only delete your own lyrics Request.'], 403);
        }
        $lyricsRequest ->delete();

        return response()->json(['msg' => 'lyrics Request deleted'],200);
    }
}
