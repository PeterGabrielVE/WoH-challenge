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
        Schema::create('battles', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('Nombre del partido');
            $table->unsignedBigInteger('player1_id')->comment('Jugador 1');
            $table->unsignedBigInteger('player2_id')->comment('Jugador 2');
            $table->unsignedBigInteger('winner_id')->comment('Ganador del partido');
            $table->integer('status')->comment('(1) Esperando; (2) En Progreso; (3) Finalizado');

            $table->foreign("player1_id")
                ->references("id")
                ->on("players")
                ->onDelete("cascade")
                ->onUpdate("cascade");
            
            $table->foreign("player2_id")
                ->references("id")
                ->on("players")
                ->onDelete("cascade")
                ->onUpdate("cascade");
            
            $table->foreign("winner_id")
                ->references("id")
                ->on("players")
                ->onDelete("cascade")
                ->onUpdate("cascade");    

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
        Schema::dropIfExists('battles');
    }
};
