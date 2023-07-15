<?php

namespace App\Factories;

use App\Models\Player;

class PlayerFactory
{
    public function create($data)
    {
        return new Player([
            'name' => $data['name'],
            'email' => $data['email'],
            'type' => $data['type'],
            'life' => $data['life'],
            'attack' => 5,
            'defense' => 5,
        ]);
    }
}