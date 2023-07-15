<?php
namespace App\Factories;

use App\Models\ItemPlayer;

class ItemPlayerFactory
{
    public function create($player_id, $item_id)
    {
        return new ItemPlayer([
            'player_id' => $player_id,
            'item_id' => $item_id
        ]);
    }
}