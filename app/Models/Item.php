<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;
    protected $table = 'items';
    protected $fillable = ['name','type','attack','defense'];

    public function players() {
    	return $this->belongsToMany('App\Models\Player');
    }
}
