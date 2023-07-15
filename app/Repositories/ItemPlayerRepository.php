<?php

namespace App\Repositories;

use App\Models\Item;
use App\Models\Player;
use App\Models\Itemplayer;

class ItemPlayerRepository
{
    public function create($player_id, $item_id)
    {
        $player = Player::find($player_id);
        $item = Item::find($item_id);

        if (!$player || !$item) {
            throw new \Exception("jugador o item no encontrado");
        }

        $itemPlayer = ItemPlayer::create([
            'player_id' => $player_id,
            'item_id' => $item_id
        ]);
        
        return $itemPlayer;
    }
}