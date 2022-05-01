<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $password = Hash::make('3223');
        $users = [
            ['name' => 'test', 'email' => 'test@test.test', 'password' => $password]
        ];

        foreach ($users as $user){
            $user['created_at'] = Carbon::now();
            $user['updated_at'] = Carbon::now();
            DB::table('players')->insert($user);
        }
    
    }
}
