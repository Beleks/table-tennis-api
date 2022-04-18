<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tournament;
use App\Models\Player;
use App\Models\Duel;
use App\Http\Requests\Tournament\TournamentRequest;

class TournamentController extends Controller
{
    public function outAllTournaments(){
        return response()->json(Tournament::get()); // вывести всю таблицу Tournament
    }


    public function createTournament(TournamentRequest $request){
   
        $id_tournament = Tournament::create([ // создать tournament по данным из request
            'type' => $request->input('type'),
            'number_participants' => $request->input('number_participants')
        ])->id; 

        
        //return response()->json($request->input('duels')[1]);

        $counter = 0;
        foreach ($request->input('duels') as $duel){
            $counter++;
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
                'id_tournament' => $id_tournament,
                'index_duel' => $counter
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
        }
    }
}
