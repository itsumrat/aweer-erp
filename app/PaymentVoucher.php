<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentVoucher extends Model
{
    public function user(){
    	return $this->belongsTo('\App\User', 'user_id');
    }

    public function location(){
    	return $this->belongsTo('\App\Location', 'total_location');
    }

    public function vendor(){
    	return $this->belongsTo('\App\Vendor', 'vendor_code');
    }

    public function purchase(){
    	return $this->belongsTo('\App\Purchase', 'purchase_id');
    }
}
