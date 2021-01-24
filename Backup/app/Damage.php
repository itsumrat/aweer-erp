<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Damage extends Model
{
    public function product(){
    	return $this->belongsTo('\App\Product', 'item_id');
    }
    public function store(){
    	return $this->belongsTo('\App\Store', 'location');
    }
}
