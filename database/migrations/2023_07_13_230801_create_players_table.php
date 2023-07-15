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
        Schema::create('players', function (Blueprint $table) {
            $table->id();
            $table->string('name',200)->comment('Nombre del jugador');
            $table->string('email',50)->unique()->comment('Correo del jugador');
            $table->integer('type')->comment('Tipo (0)👨🏻Humano (1)🧟‍♂️Zombie');
            $table->integer('life')->default(100)->comment('Vida del jugador');
            $table->integer('attack')->nullable()->comment('Ataque del jugador');
            $table->integer('defense')->nullable()->comment('Defensa del jugador');
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
        Schema::dropIfExists('players');
    }
};
