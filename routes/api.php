<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('players','PlayerController');
Route::resource('items','ItemController');
Route::resource('itemPlayer','ItemPlayerController');
Route::resource('battles','BattleController');

Route::post('createBattle', 'BattleController@start');
Route::post('fight', 'BattleController@fight');

Route::get('getPlayerUlti', 'PlayerController@getPlayerUlti');


