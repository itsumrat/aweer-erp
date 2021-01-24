<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VendorTransaction extends Model
{
    public function vendor(){
    	return $this->belongsTo('\App\Vendor', 'vendor_id');
    }
    public function purchase_items(){
    	return $this->hasMany('\App\PurchaseReturnItems', 'purchase_return_id');
    }

    public function locationStore(){
    	return $this->belongsTo('\App\Location', 'location_id');
    }
}
