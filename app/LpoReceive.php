<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LpoReceive extends Model
{
    public function purchase(){
    	return $this->belongsTo('\App\Purchase');
    }

    public function user(){
    	return $this->belongsTo('\App\User', 'user_id');
    }
    public function lop_receive_items(){
    	return $this->hasMany('\App\LpoReceiveItem', 'lpo_receive_id');
    }
}
