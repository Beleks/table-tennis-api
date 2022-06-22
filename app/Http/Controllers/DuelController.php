<?php

namespace App\Http\Controllers;
use App\Models\Player;
use App\Models\Duel;
use App\Models\Tournament;
use App\Http\Requests\Duel\DuelRequest;
use App\Http\Resources\Duel\DuelResource;

class DuelController extends Controller
{
    public function showDuels(){ 
        return DuelResource::collection(Duel::whereNull('id_tournament')->orderByDesc('id')->cursorPaginate());
    }


    public function showPlayerDuels(Player $player){ 
        $sh = Duel::where('id_first', $player->id)->orwhere('id_second', $player->id)->whereNull('id_tournament')->orderByDesc('id')->get();
        $temp = Duel::where('id_first', $player->id)->orwhere('id_second', $player->id)->whereNotNull('id_tournament')->orderByDesc('id')->pluck('id_tournament');
        
        return response()->json(/*$title*/['duels' => $sh, 'tournaments' => $temp]);
    }

    public function showTournamentDuels(Tournament $tournament){ 
        return DuelResource::collection(Duel::where('id_tournament', $tournament->id)->orderBy('index_duel')->get());
    }

    public function createDuel(DuelRequest $request, $id_tournament = NULL) 
    {
        $duel = $request->all();

        $id_first = $duel['id_first'];
        $id_second = $duel['id_second'];

        $rating_first = Player::find($id_first)->rating;
        $rating_second = Player::find($id_second)->rating;

        $playerController = new PlayerController();
        
        if ($duel['score_first'] > $duel['score_second']){
            $playerController->updatePlayers($id_first, $id_second);
        } elseif($duel['score_first'] < $duel['score_second']) {
            $playerController->updatePlayers($id_second, $id_first);
        } else {
            return response()->json('Ничья недоступна', 400);
        }

        Duel::create([ 
            'id_first' => $id_first,
            'id_second' => $id_second,
            'score_first' => $duel['score_first'],
            'score_second' => $duel['score_second'],
            'rating_first' => $rating_first,
            'rating_second' => $rating_second,
            'id_tournament' => $id_tournament,
            'index_duel' => $duel['index_duel']
        ]); 
    }
}
