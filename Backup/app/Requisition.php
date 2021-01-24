<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Requisition extends Model
{
    public function requisition_from_location(){
    	return $this->belongsTo('\App\Location', 'requisition_from');
    }
    public function requisition_to_location(){
    	return $this->belongsTo('\App\Location', 'requisition_to');
    }

    public function requisition_items(){
    	return $this->hasMany('\App\RequisitionWiseItem', 'requisition_id');
    }

    // public function total_quantity(){
    // 	return $this->requisition_items()->sum('quantity');
    // }
}
