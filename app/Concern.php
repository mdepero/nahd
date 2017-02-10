<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Concern extends Model
{
    
    public function area(){

    	$this->belongsTo('App\FConcernArea');
    }

    public function section(){

    	$this->belongsTo('App\Section');
    }
}
