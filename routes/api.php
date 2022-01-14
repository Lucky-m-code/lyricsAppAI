<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\LyricsController;
use App\Http\Controllers\LyricsRequestController;
use App\Http\Controllers\ManageAccountController;
use App\Http\Controllers\RoleController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/






Route::post('register', [RegisterController::class, 'register']);
Route::post('login', [LoginController::class, 'login']);
Route::get('/public/lyrics', [LyricsController::class, 'index']);


Route::middleware('auth:sanctum')->group(function () {

    Route::apiResource('lyrics',LyricsController::class);

    Route::get('lyricsRecom',[LyricsController::class, 'getRecom']);
    Route::apiResource('lyricsRequest', LyricsRequestController::class);
    Route::apiResource('favouriteLyrics', LyricsRequestController::class);
    Route::apiResource('role', RoleController::class);
    Route::get('/userlyrics/{id}', [LyricsController::class, 'userLyrics']);
    Route::get('/userlyricsrequest/{id}', [LyricsRequestController::class, 'userLyricsRequest']);
    Route::get('/user/lyrics', [LyricsController::class, 'lyricsStatusTrue']);


    Route::get('/admin/totalstatus', [LyricsController::class, 'totalStatus'])->middleware('admin');
    Route::get('/admin/lyrics', [LyricsController::class, 'lyricsStatusFalse'])->middleware('admin');
    Route::put('/admin/lyrics/{id}', [LyricsController::class, 'approve'])->middleware('admin');
    Route::get('/admin/isvalid', [LoginController::class, 'isValid']);

    Route::get('/user/delete/{id}', [ManageAccountController::class, 'destroy']);
    Route::get('/user/edit/{id}', [ManageAccountController::class, 'update']);


});



