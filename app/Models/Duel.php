<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Duel extends Model
{
    use HasFactory;
    protected $table = 'duels';
    protected $fillable = [
        'id_first',
        'id_second',
        'score_first',
        'score_second',
        'rating_first',
        'rating_second',
        'id_tournament',
        'index_duel', 
    ];

}
