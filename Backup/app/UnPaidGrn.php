<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UnPaidGrn extends Model
{
    protected $fillable = ['date', 'purchase_id', 'location_id', 'reference', 'vendor_id', 'user_id', 'vendor_invoice', 'total_due', 'payment_date', 'is_paid',];

    public function user(){
    	return $this->belongsTo('\App\User', 'user_id');
    }

    public function location(){
    	return $this->belongsTo('\App\Location', 'location_id');
    }

    public function vendor(){
    	return $this->belongsTo('\App\Vendor', 'vendor_id');
    }

    public function purchase(){
    	return $this->belongsTo('\App\Purchase', 'purchase_id');
    }
}
