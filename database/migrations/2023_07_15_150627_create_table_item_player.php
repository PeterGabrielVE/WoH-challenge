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
        Schema::create('item_player', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('player_id');
            $table->unsignedBigInteger('item_id');
            
            $table->foreign("player_id")
                ->references("id")
                ->on("players")
                ->onDelete("cascade")
                ->onUpdate("cascade");

            $table->foreign("item_id")
                ->references("id")
                ->on("items")
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
        Schema::dropIfExists('itemForPlayer');
    }
};
