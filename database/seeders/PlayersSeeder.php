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
            ['surname' => 'Сидоров', 'name' => 'Сидор', 'patronymic' => 'Сидорович', 'victories' => 8, 'all_games' => 14, 'rating' => 109],
            ['surname' => 'Иванов', 'name' => 'Иван', 'patronymic' => 'Иванович', 'victories' => 9, 'all_games' => 10, 'rating' => 119],
            ['surname' => 'Петров', 'name' => 'Пётр', 'patronymic' => 'Петрович', 'victories' => 12, 'all_games' => 16, 'rating' => 125],
            ['surname' => 'Данилов', 'name' => 'Данил', 'victories' => 5, 'all_games' => 5, 'rating' => 121],
            ['surname' => 'Максимов', 'name' => 'Максим'],

        ];

        foreach ($players as $player){
            $player['created_at'] = Carbon::now();
            $player['updated_at'] = Carbon::now();
            DB::table('players')->insert($player);
        }
    }
}
