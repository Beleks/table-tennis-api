<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Player;
use App\Models\Duel;

class DuelController extends Controller
{
    public function playerDuelsID(Player $player){
        return response()->json(Duel::where('id_first', $player->id)->orwhere('id_second', $player->id)->select('id')->get()); // вывести id матчей в которых участвовал игрок
    }

    public function outAllDuels(){
        return response()->json(Duel::get()); // вывести всю таблицу Duels
    }

    public function createDuel(Request $request) // создать Duel
    {
        $id_first = $request->input('id_first');
        $id_second = $request->input('id_second');

        $raiting_first = Player::find($id_first)->raiting;
        $raiting_second = Player::find($id_second)->raiting;

        
        Duel::create([
            'id_first' => $id_first,
            'id_second' => $id_second,
            'score_first' => $request->input('score_first'),
            'score_second' => $request->input('score_second'),
            'raiting_first' => $raiting_first,
            'raiting_second' => $raiting_second,
        ]); // создать дуэль по данным из request


        
        
        if ($request->input('score_first') > $request->input('score_second')){
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
