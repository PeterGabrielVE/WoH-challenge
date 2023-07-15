<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemPlayer extends Model
{
    use HasFactory;
    protected $table = 'item_player';
    protected $fillable = ['player_id','item_id'];
}
