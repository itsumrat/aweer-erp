<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PettyCash extends Model
{
    public function location(){
    	return $this->belongsTo('\App\Location', 'location_id');
    }
}
