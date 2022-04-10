<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DuelsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $duels = [
            ['id_first' => 1, 'id_second' => 2, 'score_first' => 3, 'score_second' => 0, 'raiting_first' => 110, 'raiting_second' => 120, 'id_tournament' => NULL, 'index_match' => NULL],
            ['id_first' => 3, 'id_second' => 2, 'score_first' => 2, 'score_second' => 1, 'raiting_first' => 130.64, 'raiting_second' => 112.8, 'id_tournament' => 1, 'index_match' => 0],
            ['id_first' => 1, 'id_second' => 4, 'score_first' => 0, 'score_second' => 3, 'raiting_first' => 125.643421235, 'raiting_second' => 110, 'id_tournament' => 1, 'index_match' => 1],
            ['id_first' => 4, 'id_second' => 3, 'score_first' => 3, 'score_second' => 0, 'raiting_first' => 117, 'raiting_second' => 132, 'id_tournament' => 1, 'index_match' => 2],
        ];

        foreach ($duels as $duel){
            $duel['created_at'] = Carbon::now();
            $duel['updated_at'] = Carbon::now();
            DB::table('duels')->insert($duel);
        }
    }
}
