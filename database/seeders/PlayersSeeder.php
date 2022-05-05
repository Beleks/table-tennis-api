<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class PlayersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $players = [
            ['surname' => 'Сидоров', 'name' => 'Сидор', 'patronymic' => 'Сидорович', 'victories' => 8, 'looses' => 5, 'rating' => 109],
            ['surname' => 'Иванов', 'name' => 'Иван', 'patronymic' => 'Иванович', 'victories' => 9, 'looses' => 3, 'rating' => 119],
            ['surname' => 'Петров', 'name' => 'Пётр', 'patronymic' => 'Петрович', 'victories' => 12, 'looses' => 7, 'rating' => 125],
            ['surname' => 'Данилов', 'name' => 'Данил', 'victories' => 5, 'looses' => 9, 'rating' => 121],
            ['surname' => 'Максимов', 'name' => 'Максим'],

        ];

        foreach ($players as $player){
            $player['created_at'] = Carbon::now();
            $player['updated_at'] = Carbon::now();
            DB::table('players')->insert($player);
        }
    }
}
