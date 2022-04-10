<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PhpParser\Node\Scalar\MagicConst\Function_;

class Player extends Model
{
    use HasFactory;

    protected $fillable = [
        'surname',
        'name',
        'patronomyc',
    ];

    public function showPlayerDuels(){
        return $this->hasMany(duel::class, 'id_first', 'id');
        
    }


}
