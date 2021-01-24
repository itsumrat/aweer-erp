<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
public function children() {
    return $this->hasMany('Category','parent_category');
}
public function parent() {
    return $this->belongsTo('Category','parent_category');
}
}
