<?php

namespace App\Repositories;

use App\Models\Player;

class PlayerRepository
{
    public function create($data)
    {
        $player = Player::create($data);

        if (!$player) {
            throw new \Exception("Error al crear el jugador");
        }

        return $player;
    }


}