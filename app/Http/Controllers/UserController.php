<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use GuzzleHttp\Promise\Create;
use App\Models\User;

class UserController extends Controller
{
    public function reg(){
        $password = Hash::make('3223');

        return response()->json(User::create(['name' => 'test', 'email' => 'test@test.test', 'password' => $password]));
    }
}
