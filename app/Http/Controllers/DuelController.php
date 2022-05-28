<?php

namespace App\Http\Controllers;
use App\Models\Player;
use App\Models\Duel;
use App\Models\Tournament;
use App\Http\Requests\Duel\DuelRequest;
use App\Http\Resources\Duel\DuelResource;

class DuelController extends Controller
{
    public function showAllDuels(){ 
        return DuelResource::collection(Duel::orderByDesc('id')->cursorPaginate());
    }

    public function showPlayerDuelsInfo(Player $player){ 
        return DuelResource::collection(Duel::where('id_first', $player->id)->orwhere('id_second', $player->id)->orderByDesc('id')->cursorPaginate());
    }

    public function showTournamentDuelsInfo(Tournament $tournament){ 
        return DuelResource::collection(Duel::where('id_tournament', $tournament->id)->orderByDesc('id')->get());
    }

    public function createDuel(DuelRequest $request, $id_tournament = NULL) 
    {
        $duel = $request->all();

        $id_first = $duel['id_first'];
        $id_second = $duel['id_second'];

        $rating_first_for_duel = Player::find($id_first)->rating;
        $rating_second_for_duel = Player::find($id_second)->rating;

        if ($duel['score_first'] > $duel['score_second']){
            $delta_rating = (100 - ($rating_first_for_duel - $rating_second_for_duel))/10;
            $rating_first = $rating_first_for_duel + $delta_rating;
            $rating_second = $rating_second_for_duel - $delta_rating;

            if($rating_second < 1){
                $rating_second = 1;
            }

            $victories_first = Player::find($id_first)->victories + 1;
            $looses_second = Player::find($id_second)->looses + 1;
            
            Player::find($id_first)->update([ 
                'victories' => $victories_first,
                'rating' => $rating_first
            ]);
    
            Player::find($id_second)->update([ 
                'looses' => $looses_second,
                'rating' => $rating_second
            ]);
        } elseif($duel['score_first'] < $duel['score_second']) {
            $delta_rating = (100 - ($rating_second_for_duel - $rating_first_for_duel))/10;
            $rating_second = $rating_second_for_duel + $delta_rating;
            $rating_first = $rating_first_for_duel - $delta_rating;

            if($rating_first < 1){
                $rating_first = 1;
            }

            $looses_first = Player::find($id_first)->looses + 1;
            $victories_second = Player::find($id_second)->victories + 1;

            Player::find($id_first)->update([ 
                'looses' => $looses_first,
                'rating' => $rating_first
            ]);
    
            Player::find($id_second)->update([ 
                'victories' => $victories_second,
                'rating' => $rating_second
            ]);
        } else {
            return response()->json('Ничья недоступна', 400);
        }

        Duel::create([ 
            'id_first' => $id_first,
            'id_second' => $id_second,
            'score_first' => $duel['score_first'],
            'score_second' => $duel['score_second'],
            'rating_first' => $rating_first_for_duel,
            'rating_second' => $rating_second_for_duel,
            'id_tournament' => $id_tournament,
            'index_duel' => $duel['index_duel']
        ]); 
    }
}
