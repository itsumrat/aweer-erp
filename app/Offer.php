<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    public function buy_item(){
    	return $this->belongsTo('\App\Product', 'buy_product_id');
    }
    public function get_item(){
    	return $this->belongsTo('\App\Product', 'get_product_id');
    }
    public function unit(){
    	return $this->belongsTo('\App\Unit', 'unit_id');
    }
}
