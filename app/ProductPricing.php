<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductPricing extends Model
{
	public function productPricing(){
    	return $this->belongsTo('\App\Product', 'product_id', 'id');
    }

	public function unitPrice(){
    	return $this->belongsTo('\App\Unit', 'unit_id');
    }

    public function costs(){
    	return $this->belongsTo('\App\ProductCosting', 'product_id', 'product_id');
	}
	
    public function vendorPrice(){
    	return $this->belongsTo('\App\Vendor', 'vendor_id', 'id');
    }


    public function purchaseOrderItem(){
        return $this->hasOne('\App\PurchaseOrderWiseItem', 'barcode', 'barcode');
    }

}
