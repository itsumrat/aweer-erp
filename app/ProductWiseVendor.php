<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductWiseVendor extends Model
{
    public function vendor(){
    	return $this->belongsTo('\App\Vendor', 'vendor_id');
    }
}
