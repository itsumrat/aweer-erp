<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PromotionalProduct extends Model
{
    public function item(){
    	return $this->belongsTo('\App\Product', 'item_id');
    }
}
