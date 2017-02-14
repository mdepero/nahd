<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Concern extends Model
{
    
    public function area(){

    	return $this->belongsTo('App\FConcernArea', 'area_id');
    }

    public function section(){

    	return $this->belongsTo('App\Section');
    }
}
