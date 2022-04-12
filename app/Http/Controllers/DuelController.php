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

    public function createDuel(Request $request) // создать нового игрока
    {
        $dueljson = $request->input();
        //$duel->culcRaiting();

        $duelarray = json_decode($dueljson);


        //$duel
        $is_first_winner = false;
        
        //return response()->$duel;
/*
        $id_first = $request->input('id_first');
        $id_second = $request->input('id_second');
        $raiting_first = $request->input('raiting_first');
        $raiting_second = $request->input('raiting_second');

        $is_first_winner = false;
        
        if ($request->input('score_first') > $request->input('score_second')){
            $is_first_winner = true;
            culcRaiting();
        }



        (100 - (PВ - PП)) / 10;


        //Duel::create($request->all()); 
    
        return response()->json($request->all());*/
    }

}
