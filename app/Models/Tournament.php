<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tournament extends Model
{
    use HasFactory;
    protected $table = 'tournaments';

    protected $fillable = [
        'type',
        'number_participants',
    ];

    public function outAllTournaments(){
        return response()->json(Tournament::get()); // вывести всю таблицу Tournament
    }
}
