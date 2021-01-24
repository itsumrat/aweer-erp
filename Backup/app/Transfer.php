<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transfer extends Model
{
    public function transfer_from_location(){
    	return $this->belongsTo('\App\Location', 'transfer_from');
    }
    public function transfer_to_location(){
    	return $this->belongsTo('\App\Location', 'transfer_to');
    }

        public function transfer_items(){
    	return $this->hasMany('\App\TransferItems', 'transfer_id');
    }
}
