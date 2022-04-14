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
        'raiting_first',
        'raiting_second',
        'id_tournament',
        'index_duel', 
    ];
/*
    protected $attributes = [
        'raiting_first' => 0,
        'raiting_second'=> 0,
    ];*/


/*
    public function culcRaiting(){
        return $this->hasMany(duel::class, 'id_first', 'id');
    }
*/

}
