<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FConcernArea extends Model
{
    
    public function options(){

    	return $this->hasMany('App\FConcernOption', 'f_concern_area_id');
    }

    public function section(){

    	return $this->belongsTo('App\FSection', 'f_section_id');
    }

    public function concerns(){

    	return $this->hasMany('App\Concern', 'area_id');
    }
}
