<?php

namespace App\Http\Controllers;

use App\Http\Resources\LoginResource;
use App\Http\Resources\LyricsResource;
use App\Models\Lyrics;
use App\Models\LyricsRequest;
use App\Models\User;
use App\Utiils\RecomHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PHPUnit\Util\Exception;
use Laracombee;
use Recombee\RecommApi\Requests\AddItem;

class LyricsController extends Controller
{


    public function index()
    {

        return Lyrics::paginate(15);
        //    return LyricsResource::collection(Lyrics::all());
    }
    public function getRecom(Request $request)
     {
       //     $lyrics = array();
        // Prepare the request for recombee server, we need 10 recommended items for a given user.
        // $recommendations = Laracombee::recommendTo($user, 10)->wait();
        $recomHelper = RecomHelper::getInstance();
        $recommendations = $recomHelper->getRecomForUser($request->user()->id);
        foreach ($recommendations as $id) {
            $lyrics[] = Lyrics::find($id);
        }
        return $lyrics;
    }
    public function lyricsStatusTrue()
    {
        return Lyrics::select("*")->where("status", true)->get();
    }

    public function lyricsStatusFalse()
    {
        return Lyrics::select("*")->where("status", false)->get();
    }


    public function userLyrics($id)
    {
        return LyricsResource::collection(lyrics::with('user')->where("user_id", $id)->get());
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'music_name' => 'required',
            'artist_name' => 'required',
            'lyrics' => 'required',
        ]);

        $user = $request->user()->id;

        $lyrics = Lyrics::create([
            'music_name' => $request['music_name'],
            'artist_name' => $request['artist_name'],
            'lyrics' => $request['lyrics'],
            'url' => $request['url'],
            'status' => false,
            'user_id' => $user,

        ]);


        $response = [
            'lyrics' => $lyrics,
            //'user name' => $request->user()->name
        ];
        $recomHelper = RecomHelper::getInstance();
        $recomHelper->addItem($lyrics);
        // $addUser = Laracombee::addItem($lyrics);

        // Laracombee::send($addUser)->then(function () {
        //     // Success.
        // })->otherWise(function ($error) {
        //     // Handle Exeption.
        // })->wait();
        return response()->json(['status_code' => 400, 'response' => $response]);
    }

    //Display the specified resource.
    public function show(Request $request, $id)
    {

        $recomHelper = RecomHelper::getInstance();
        $recomHelper->addItem($request->user()->id, $id);
        // Laracombee::addDetailView($request->user()->id, $id);
        return Lyrics::find($id);
    }



    //Update the specified resource in storage.
    public function update(Request $request, Lyrics $lyric)
    {
        $this->validate($request, [
            'music_name' => 'required',
            'artist_name' => 'required',
            'lyrics' => 'required',

        ]);
        $response = [
            'user' => $request->user()->name,
            'lyrics_user_id' => $lyric
        ];

        if ($request->user()->id !== $lyric->user_id) {

            return response()->json(['error' => 'You can only edit your own lyrics.', 'response' => $response], 403);
        }
        $lyric->update($request->only(['music_name', 'artist_name', 'lyrics', 'url']));
        return new LyricsResource($lyric);
    }

    //Update the specified resource in storage.
    public function approve(Request $request, $id)
    {
        try {
            $this->validate($request, [
                'status' => 'required',
            ]);
            $lyrics = Lyrics::where('id', $id)->first();

            $response = [
                'user' => $request->user()->name,
                'lyrics_user_id' => $lyrics
            ];

            if (!Auth::user()->isAdmin()) {
                return response()->json(['error' => 'only admin can update.', 'response' => $response], 403);
            }
            $lyrics->update($request->only(['status']));

            return new LyricsResource($lyrics);
        } catch (Exception $e) {
            echo $e;
        }
    }




    //Remove the specified resource from storage.
    //The HTTP 204 No Content success status response code indicates that a request has succeeded,
    //but that the client doesn't need to navigate away from its current page
    public function destroy(Request $request, Lyrics $lyric)
    {
        if ($request->user()->id != $lyric->user_id) {
            return response()->json(['error' => 'You can only delete your own lyrics.'], 403);
        }
        $lyric->delete();

        return response()->json(['msg' => 'lyrics deleted'], 200);
    }

    public function usersLyrics($id)
    {
        $user = Auth::user();
        $lyrics = DB::table('lyrics')->where('user_id', $user->id)->get();
    }



    public function totalStatus()
    {
        $lyrics = Lyrics::all()->count();
        $lyricsRequest =  LyricsRequest::all()->count();
        $user =  User::all()->count();
        $totalApprovedLyrics = Lyrics::select("*")->where("status", true)->count();
        $totalUnApprovedLyrics = Lyrics::select("*")->where("status", false)->count();

        return  $totalValue = [
            'totalUser' => $user,
            'totalLyrics' => $lyrics,
            'totalLyricsRequest' => $lyricsRequest,
            'totalApprovedLyrics' => $totalApprovedLyrics,
            'totalUnApprovedLyrics' => $totalUnApprovedLyrics

        ];
    }
}
