<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RequisitionWiseItem extends Model
{
    public function item(){
    	return $this->belongsTo('\App\Item', 'item_id');
    }

    public function requistion(){
    	return $this->belongsTo('\App\Requisition', 'requisition_id');
    }
}
