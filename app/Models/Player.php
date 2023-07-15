<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    use HasFactory;

    protected $table = 'players';
    protected $fillable = ['name', 'email', 'type', 'life','attack', 'defense'];

    public function items() {
    	return $this->belongsToMany('App\Models\Item');
    }
    
}
