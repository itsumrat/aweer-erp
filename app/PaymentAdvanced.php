<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentAdvanced extends Model
{
	  protected $fillable = ['date', 'vendor_id', 'description', 'amount', 'paid_by'];
	  
    public function vendor() {
    	return $this->belongsTo('App\Vendor', 'vendor_id');
    }
}
