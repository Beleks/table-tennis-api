<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;
use App\Http\Controllers\PlayerController;
use App\Http\Controllers\DuelController;
use App\Http\Controllers\TournamentController;



Route::get('/', function () {
    return view('welcome');
});




Route::get('/test', [TestController::class, 'testGet']);
Route::get('/create', [TestController::class, 'testCreate']);
Route::get('/display', [TestController::class, 'testDisplay']);
Route::get('/edit', [TestController::class, 'testEdit']);
Route::get('/players/{player}', [TestController::class, 'testPlayers']);
Route::post('/post', [TestController::class, 'testPost']);
//Route::put('/update/{player}', [TestController::class, 'testUpdate']);
Route::get('/phistory/{player}', [TestController::class, 'testDuels']);
 

    //   API    API     API    API
    //   API    API     API    API
    //   API    API     API    API
    //   API    API     API    API
    //   API    API     API    API
    //   API    API     API    API
    //   API    API     API    API


Route::get('/players', [PlayerController::class, 'outAllPlayers']);

Route::get('/players/{player}/duelsid', [DuelController::class, 'playerDuelsID']);

Route::get('/duels', [DuelController::class, 'outAllDuels']);
Route::get('/tournaments', [TournamentController::class, 'outAllTournaments']);
Route::post('/create/player', [PlayerController::class, 'createPlayer']);
Route::post('/create/duel', [DuelController::class, 'createDuel']);