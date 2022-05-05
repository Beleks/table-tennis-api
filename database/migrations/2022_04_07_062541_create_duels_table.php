<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('duels', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('id_first');
            $table->unsignedInteger('id_second');
            $table->unsignedTinyInteger('score_first');
            $table->unsignedTinyInteger('score_second');
            $table->float('rating_first');
            $table->float('rating_second');
            $table->unsignedInteger('id_tournament')->nullable();
            $table->unsignedTinyInteger('index_duel')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('duels');
    }
};
