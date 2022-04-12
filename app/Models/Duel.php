<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Duel extends Model
{
    use HasFactory;

    public function culcRaiting(){
        return $this->hasMany(duel::class, 'id_first', 'id');
    }


}
