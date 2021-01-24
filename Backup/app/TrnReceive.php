<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TrnReceive extends Model
{
    public function item(){
    	return $this->belongsTo('App\Item', 'item_id');
    }

    public function user(){
    	return $this->belongsTo('App\User', 'user_id');
    }
}
