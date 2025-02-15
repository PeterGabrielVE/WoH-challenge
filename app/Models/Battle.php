<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Battle extends Model
{
    use HasFactory;

    protected $table = 'battles';
    protected $fillable = ['name','player1_id','player2_id','winner_id','status'];

}
