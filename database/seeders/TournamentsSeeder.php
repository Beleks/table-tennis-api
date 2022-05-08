<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class TournamentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tournaments = [
            ['type' => 'classic', 'number_participants' => 4],
        ];

        foreach ($tournaments as $tournament){
            $tournament['created_at'] = Carbon::now();
            $tournament['updated_at'] = Carbon::now();
            DB::table('tournaments')->insert($tournament);
        }
    }
}
