<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;



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


