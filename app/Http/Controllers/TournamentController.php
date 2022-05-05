<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tournament;
use App\Models\Player;
use App\Models\Duel;
use App\Http\Requests\Tournament\TournamentRequest;
use App\Http\Requests\Duel\DuelRequest;
use App\Http\Resources\Tournament\TournamentResource;
use App\Http\Controllers\DuelController;

class TournamentController extends Controller
{
    public function showAllTournaments(){  // вывести всю таблицу Tournament
        //return response()->json(Tournament::get()); 
        return TournamentResource::collection(Tournament::get());
    }


    public function createTournament(TournamentRequest $request){
   
        $id_tournament = Tournament::create([ // создать tournament по данным из request
            'type' => $request->validated('type'),
            'number_participants' => $request->validated('number_participants')
        ])->id; 

        
        $duelController = new DuelController();
        foreach ($request->validated('duels') as $duel){
            $duelRequest = new DuelRequest();
            $duelRequest->replace($duel);
            $duelController->createDuel($duelRequest, $id_tournament);
        }
    }
}
