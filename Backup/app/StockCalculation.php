<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StockCalculation extends Model
{
    public function item(){
    	return $this->belongsTo('\App\Product', 'item_id');
    }
    public function location(){
    	return $this->belongsTo('\App\Store', 'store_id');
    }
}
