<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Player;
use App\Models\Duel;
use App\Models\Tournament;
use App\Http\Requests\Duel\DuelRequest;
use App\Http\Resources\Duel\DuelResource;
use Illuminate\Auth\Events\Validated;

class DuelController extends Controller
{
    public function outAllDuels(){ // вывести всю таблицу Duels
        //return response()->json(Duel::get()); 
        return DuelResource::collection(Duel::get());
    }

    public function showPlayerDuelsID(Player $player){ // вывести id матчей в которых участвовал игрок
        return response()->json(Duel::select('id')->where('id_first', $player->id)->orwhere('id_second', $player->id)->get()); 
        //return $player->showDuelsId();
    }

    public function showPlayerDuelsInfo(Player $player){ // вывести информацию о матчах в которых участвовал игрок
        //return response()->json(Duel::where('id_first', $player->id)->orwhere('id_second', $player->id)->get()); 
        return DuelResource::collection(Duel::where('id_first', $player->id)->orwhere('id_second', $player->id)->get());
    }


    public function showTournamentDuelsID(Tournament $tournament){ // вывести id матчей турнира
        return response()->json(Duel::select('id')->where('id_tournament', $tournament->id)->get()); 
    }

    public function showTournamentDuelsInfo(Tournament $tournament){ // вывести информацию о матчах турнира
        //return response()->json(Duel::where('id_tournament', $tournament->id)->get()); 
        return DuelResource::collection(Duel::where('id_tournament', $tournament->id)->get());
    }


    public function createDuel(DuelRequest $request) // создать Duel
    {
        $duel = $request->validated();


        $id_first = $duel['id_first'];
        $id_second = $duel['id_second'];

        $raiting_first = Player::find($id_first)->raiting;
        $raiting_second = Player::find($id_second)->raiting;

        
        Duel::create([
            'id_first' => $id_first,
            'id_second' => $id_second,
            'score_first' => $duel['score_first'],
            'score_second' => $duel['score_second'],
            'raiting_first' => $raiting_first,
            'raiting_second' => $raiting_second,
        ]); // создать дуэль по данным из request


        
        
        if ($duel['score_first'] > $duel['score_second']){
            $tempRaiting = (100 - ($raiting_first - $raiting_second))/10;
            $raiting_first = $raiting_first + $tempRaiting;
            $raiting_second = $raiting_second - $tempRaiting;

            if($raiting_second < 1){
                $raiting_second = 1;
            }

            $victories_first = Player::find($id_first)->victories + 1;
            $looses_second = Player::find($id_second)->looses + 1;
            

            Player::find($id_first)->update([ //Редактирование игрока id_first
                'victories' => $victories_first,
                'raiting' => $raiting_first
            ]);
    
            Player::find($id_second)->update([ //Редактирование игрока id_second
                'looses' => $looses_second,
                'raiting' => $raiting_second
            ]);

        } else {
            $tempRaiting = (100 - ($raiting_second - $raiting_first))/10;
            $raiting_second = $raiting_second + $tempRaiting;
            $raiting_first = $raiting_first - $tempRaiting;

            if($raiting_first < 1){
                $raiting_first = 1;
            }

            $looses_first = Player::find($id_first)->looses + 1;
            $victories_second = Player::find($id_second)->victories + 1;


            Player::find($id_first)->update([ //Редактирование игрока id_first
                'looses' => $looses_first,
                'raiting' => $raiting_first
            ]);
    
            Player::find($id_second)->update([ //Редактирование игрока id_second
                'victories' => $victories_second,
                'raiting' => $raiting_second
            ]);
        }

        //return gettype($duel);
        //var_dump($duel);
        //return response()->json($id_second);

    }

}
