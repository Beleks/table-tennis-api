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

    public function updatePlayers($id_winner, $id_looser){

        $winner = Player::find($id_winner);
        $looser = Player::find($id_looser);

        $delta_rating = (100 - ($winner['rating'] - $looser['rating']))/10;
        $winner['rating'] += $delta_rating;
        $looser['rating'] -= $delta_rating;

        if($looser['rating'] < 1){
            $looser['rating'] = 1;
        }

        $winner['victories'] += 1;
        $winner['all_games'] += 1;
        $looser['all_games'] += 1;

        Player::find($id_winner)->update([ 
            'victories' => $winner['victories'],
            'all_games' => $winner['all_games'],
            'rating' => $winner['rating'],
        ]);

        Player::find($id_looser)->update([ 
            'all_games' => $looser['all_games'],
            'rating' => $looser['rating'],
        ]);
    }
}
