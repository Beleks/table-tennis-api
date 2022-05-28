<?php

namespace App\Http\Controllers;
use App\Models\Tournament;
use App\Http\Requests\Tournament\TournamentRequest;
use App\Http\Requests\Duel\DuelRequest;
use App\Http\Resources\Tournament\TournamentResource;
use App\Http\Controllers\DuelController;

class TournamentController extends Controller
{
    public function showAllTournaments(){
        return TournamentResource::collection(Tournament::orderByDesc('id')->cursorPaginate());
    }

    public function createTournament(TournamentRequest $request){
        $id_tournament = Tournament::create([
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
