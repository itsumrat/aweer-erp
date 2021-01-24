<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PurchaseReturnItems extends Model
{
    public function item(){
    	return $this->belongsTo('\App\Item', 'item_id');
    }
    public function purchase(){
    	return $this->belongsTo('\App\Purchase', 'purchase_id');
    }
}
