<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    public $table = 'products';
    
    public function costs(){
    	return $this->hasOne('\App\ItemCosting', 'product_id');
    }
    public function prices(){
    	return $this->hasOne('\App\ItemPricing', 'product_id');
    }
    public function product_wise_vendor(){
        return $this->hasMany('App\ProductWiseVendor', 'product_id');
    }
    
}
