<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tournament;

class TournamentController extends Controller
{
    public function outAllTournaments(){
        return response()->json(Tournament::get()); // вывести всю таблицу Tournament
    }
}
