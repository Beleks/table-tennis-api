<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Player;
use App\Http\Requests\Player\PlayerRequest;
use App\Http\Resources\Player\PlayerResource;

class PlayerController extends Controller
{
    public function showAllPlayers() //вывести всю таблицу Player
    {
        //return response()->json(Player::get());
        return PlayerResource::collection(Player::get());
    }

    public function createPlayer(PlayerRequest $request) // создать нового игрока
    {
        $player = $request->validated();

        Player::create([
            'surname' => $player['surname'],
            'name' => $player['name'],
            'patronymic' => $player['patronymic']
        ]); 

        return response()->json($player);
    }

    public function editPlayer(PlayerRequest $request, Player $player) // редактировать данные игрока
    {
        $player->update($request->validated());

        return response()->json($request->validated());
    }
}
