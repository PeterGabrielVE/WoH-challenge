<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    use HasFactory;

    protected $table = 'players';
    protected $fillable = ['name', 'email', 'type', 'life','attack', 'defense', 'lastAttack'];

    public function items() {
    	return $this->belongsToMany('App\Models\Item');
    }

    public function getAtaqueTotal($attack_id)
    {
        $ataque = 5;
        foreach ($this->items as $item) {
            if ($item->type == 2) {
                $ataque += $item->attack;
            }
        }

        switch ($attack_id) {
            case 1:
                $ataque = $ataque;
                break;
            case 2:
                $ataque = $ataque * 0.8;
                break;
            case 3:
                $ataque = $ataque * 2;
                break;
            
            default:
                $ataque;
                break;
        }
        return $ataque;
    }

    public function getDefensaTotal()
    {
        $defensa = 5;
        foreach ($this->items as $item) {
            if ($item->type == 1) {
                $defensa +=$item->defense;
            }
        }
        return $defensa;
    }

    public function getPuntosDeVida()
    {
        return $this->life;
    }
    
}
