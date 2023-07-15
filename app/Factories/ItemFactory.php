<?php

namespace App\Factories;

use App\Models\Item;

class ItemFactory
{
    public function create($data)
    {
        return new Item([
            'name' => $data['name'],
            'type' => $data['type'],
            'attack' => $data['attack'],
            'defense' => $data['defense'],
        ]);
    }
}