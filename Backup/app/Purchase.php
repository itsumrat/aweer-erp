<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    public function vendor(){
    	return $this->belongsTo('\App\Vendor', 'vendor_id');
    }
    public function purchase_items(){
    	return $this->hasMany('\App\PurchaseOrderWiseItem', 'purchase_id');
    }
    public function foc_items(){
    	return $this->hasMany('\App\FOCItems', 'purchase_id');
    }
    public function location(){
    	return $this->belongsTo('\App\Location', 'location_id');
    }
}
