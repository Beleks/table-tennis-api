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
    public function showAllDuels(){ // вывести всю таблицу Duels
        //return response()->json(Duel::get()); 
        return DuelResource::collection(Duel::latest()->paginate());
    }

    public function showPlayerDuelsID(Player $player){ // вывести id матчей в которых участвовал игрок
        return response()->json(Duel::select('id')->where('id_first', $player->id)->orwhere('id_second', $player->id)->get()); 
        //return $player->showDuelsId();
    }

    public function showPlayerDuelsInfo(Player $player){ // вывести информацию о матчах в которых участвовал игрок
        //return response()->json(Duel::where('id_first', $player->id)->orwhere('id_second', $player->id)->get()); 
        return DuelResource::collection(Duel::where('id_first', $player->id)->orwhere('id_second', $player->id)->latest()->paginate());
    }


    public function showTournamentDuelsID(Tournament $tournament){ // вывести id матчей турнира
        return response()->json(Duel::select('id')->where('id_tournament', $tournament->id)->get()); 
    }

    public function showTournamentDuelsInfo(Tournament $tournament){ // вывести информацию о матчах турнира
        //return response()->json(Duel::where('id_tournament', $tournament->id)->get()); 
        return DuelResource::collection(Duel::where('id_tournament', $tournament->id)->latest()->get());
    }


    public function createDuel($request, $id_tournament = NULL) // создать Duel
    {
        $duel = $request->all();


        $id_first = $duel['id_first'];
        $id_second = $duel['id_second'];

        $rating_first = Player::find($id_first)->rating;
        $rating_second = Player::find($id_second)->rating;

        
        Duel::create([ // создать дуэль по данным из request
            'id_first' => $id_first,
            'id_second' => $id_second,
            'score_first' => $duel['score_first'],
            'score_second' => $duel['score_second'],
            'rating_first' => $rating_first,
            'rating_second' => $rating_second,
            'id_tournament' => $id_tournament,
            'index_duel' => $duel['index_duel']
        ]); 

        
        if ($duel['score_first'] > $duel['score_second']){
            $temprating = (100 - ($rating_first - $rating_second))/10;
            $rating_first = $rating_first + $temprating;
            $rating_second = $rating_second - $temprating;

            if($rating_second < 1){
                $rating_second = 1;
            }

            $victories_first = Player::find($id_first)->victories + 1;
            $looses_second = Player::find($id_second)->looses + 1;
            

            Player::find($id_first)->update([ //Редактирование игрока id_first
                'victories' => $victories_first,
                'rating' => $rating_first
            ]);
    
            Player::find($id_second)->update([ //Редактирование игрока id_second
                'looses' => $looses_second,
                'rating' => $rating_second
            ]);
        } else {
            $temprating = (100 - ($rating_second - $rating_first))/10;
            $rating_second = $rating_second + $temprating;
            $rating_first = $rating_first - $temprating;

            if($rating_first < 1){
                $rating_first = 1;
            }

            $looses_first = Player::find($id_first)->looses + 1;
            $victories_second = Player::find($id_second)->victories + 1;


            Player::find($id_first)->update([ //Обновление данных игрока id_first
                'looses' => $looses_first,
                'rating' => $rating_first
            ]);
    
            Player::find($id_second)->update([ //Обновление данных игрока id_second
                'victories' => $victories_second,
                'rating' => $rating_second
            ]);
        }
        //return gettype($duel);
        //var_dump($duel);
        //return response()->json($id_second);
    }
}
