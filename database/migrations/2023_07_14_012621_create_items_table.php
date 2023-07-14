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
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('name',200)->comment('Nombre del jugador');
            $table->integer('type')->comment('Tipo (0)Bota,(1)Armadura,(2)Arma');
            $table->integer('attack')->nullable()->comment('Cantidad de puntos de defensa');
            $table->integer('defense')->nullable()->comment('Cantidad de puntos de ataque');
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
        Schema::dropIfExists('items');
    }
};
