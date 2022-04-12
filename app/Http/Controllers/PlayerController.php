<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Player;

class PlayerController extends Controller
{
    public function outAllPlayers() //вывести всю таблицу Player
    {
        return response()->json(Player::get());
    }

    public function createPlayer(Request $request) // создать нового игрока
    {
        Player::create($request->all()); 
    
        return response()->json($request->all());
    }
}
