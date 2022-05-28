<?php

namespace App\Http\Controllers;
use App\Models\Player;
use App\Http\Requests\Player\PlayerRequest;
use App\Http\Resources\Player\PlayerResource;

class PlayerController extends Controller
{
    public function showAllPlayers()
    {
        return PlayerResource::collection(Player::orderByDesc('rating')->get());
    }

    public function createPlayer(PlayerRequest $request)
    {
        if(Player::orderByDesc('id')->first()->id==50) {
            return response()->json('Достигнуто максимальное количество игрков', 500);
        }

        $player = $request->validated();

        Player::create([
            'surname' => $player['surname'],
            'name' => $player['name'],
            'patronymic' => $player['patronymic']
        ]); 
    }

    public function editPlayer(PlayerRequest $request, Player $player)
    {
        $player->update($request->validated());
    }
}
