<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Repacking extends Model
{
    public function prices(){
    	return $this->hasOne('\App\ProductPricing', 'product_id');
    }

    public function category(){
    	return $this->belongsTo('\App\Category', 'category_id');
    }
    
    public function department(){
    	return $this->belongsTo('\App\Department', 'department_id');
    }
    
    public function unit(){
    	return $this->belongsTo('\App\Unit', 'unit_id');
    }

    public function product_wise_vendor(){
        return $this->hasMany('App\ProductWiseVendor', 'product_id');
    }

    public function purchase_items(){
        return $this->hasMany('App\PurchaseOrderWiseItem', 'item_id');
    }
    public function purchase_return_items(){
        return $this->hasMany('App\PurchaseReturnItems', 'item_id');
    }
}
