<?php

use Illuminate\Http\Request;
use App\Article;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => 'auth:api'], function() {
    Route::resource('articles', 'ArticleController', [ 'except' => ['index','show'] ]);
    Route::post('articles/image', 'ArticleController@storeImage');
});

Route::get('articles', 'ArticleController@index');
Route::get('articles/{article}', 'ArticleController@show');

//games
//lingo
Route::get('lingo/randomword', 'games\LingoController@randomWord');
Route::post('lingo/checkword', 'games\LingoController@checkWord');
//chess
Route::post('chess/stockfish', 'games\ChessController@stockfish');

//auth
Route::post('register', 'Auth\RegisterController@register');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout');
