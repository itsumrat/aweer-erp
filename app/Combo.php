<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Combo extends Model
{
    public function unit(){
    	return $this->belongsTo('\App\Unit', 'unit_id');
    }
    
    public function prices(){
    	return $this->hasOne('\App\ProductPricing', 'product_id');
    }
    
    public function vendor(){
    	return $this->belongsTo('\App\Vendor', 'vendor_id');
    }

    public function product_wise_vendor(){
        return $this->hasMany('App\ProductWiseVendor', 'product_id');
    }
}
