<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PlayerController;
use App\Http\Controllers\DuelController;
use App\Http\Controllers\TournamentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;

/*
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
*/

//Route::post('/login', [TournamentController::class, 'outAllTournaments']);


Route::get( '/create/user', [UserController::class, 'reg']);


//All Users
Route::get('/players', [PlayerController::class, 'showAllPlayers']);
Route::get('/duels', [DuelController::class, 'showAllDuels']);
Route::get('/tournaments', [TournamentController::class, 'showAllTournaments']);
Route::get('/players/{player}/duelsinfo', [DuelController::class, 'showPlayerDuelsInfo']);
Route::get('/tournaments/{tournament}/duelsinfo', [DuelController::class, 'showTournamentDuelsInfo']);

//Authrized Users
Route::group(['middleware' => 'jwt.auth'], function () {
    Route::post('/create/player', [PlayerController::class, 'createPlayer']);
    Route::patch('/edit/player/{player}', [PlayerController::class, 'editPlayer']);
    Route::match(['post', 'patch'], '/create/duel', [DuelController::class, 'createDuel']);
    Route::match(['post', 'patch'], '/create/tournament', [TournamentController::class, 'createTournament']);
});


//Authorization
Route::group(['middleware' => 'api', 'prefix' => 'auth'], function ($router) {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout']);
    //Route::post('refresh', [AuthController::class, 'refresh']);
    //Route::post('me', [AuthController::class, 'me']);
});

//Others
Route::get('/players/{player}/duelsid', [DuelController::class, 'showPlayerDuelsID']);
Route::get('/tournaments/{tournament}/duelsid', [DuelController::class, 'showTournamentDuelsID']);
