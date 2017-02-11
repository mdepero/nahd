<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FDescriptionArea extends Model
{
    
    public function options(){

    	return $this->hasMany('App\FDescriptionOption', 'f_description_area_id');
    }

    public function section(){

    	return $this->belongsTo('App\FSection','f_section_id');
    }

    public function descriptions(){

    	return $this->hasMany('App\Description', 'area_id');
    }
}
