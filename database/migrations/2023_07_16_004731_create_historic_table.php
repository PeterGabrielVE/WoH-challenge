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
        Schema::create('historic', function (Blueprint $table) {
            
            $table->id();
            $table->unsignedBigInteger('player_id')->nullable()->comment('Jugador');
            $table->unsignedBigInteger('battle_id')->nullable()->comment('Batalla');
            $table->unsignedBigInteger('attack_id')->nullable()->comment('Ataque');

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
        Schema::dropIfExists('historic');
    }
};
