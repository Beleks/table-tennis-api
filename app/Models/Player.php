<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PhpParser\Node\Scalar\MagicConst\Function_;

class Player extends Model
{
    use HasFactory;
    protected $table = 'players';

    protected $fillable = [
        'surname',
        'name',
        'patronomyc',
        'victories',
        'looses',
        'raiting',
    ];

    public function showDuelsId(){
        return $this->hasMany(duel::class, 'id_first', 'id');
    }

    public function updatePlayer(){

        

    }

}
