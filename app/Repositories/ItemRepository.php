<?php

namespace App\Repositories;

use App\Models\Item;

class ItemRepository
{
    public function create($data)
    {
        $item = Item::create($data);

        if (!$item) {
            throw new \Exception("Error al crear el item");
        }

        return $item;
    }


}