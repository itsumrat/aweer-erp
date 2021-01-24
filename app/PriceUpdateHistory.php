<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PriceUpdateHistory extends Model
{
    public function item(){
    	return $this->belongsTo('\App\Product', 'item_id');
    }
    public function store(){
    	return $this->belongsTo('\App\Store', 'store_id');
    }
}
