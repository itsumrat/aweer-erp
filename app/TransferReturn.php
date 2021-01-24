<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransferReturn extends Model
{
    public function transfer_from_location(){
    	return $this->belongsTo('\App\Location', 'transfer_from');
    }
    public function transfer_to_location(){
    	return $this->belongsTo('\App\Location', 'transfer_to');
    }

        public function transfer_return_items(){
    	return $this->hasMany('\App\TransferReturnItems', 'transfer_id');
    }

    public function user(){
    	return $this->belongsTo('\App\User', 'user_id');
    }
}
