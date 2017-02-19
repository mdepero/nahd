<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    
    public function concerns(){

    	return $this->hasMany('App\Concern');
    }

    public function images(){

        return $this->hasMany('App\Image');
    }

    public function fsection(){

    	return $this->belongsTo('App\FSection', 'f_section_id');
    }

    public function descriptions(){

    	return $this->hasMany('App\Description');
    }

    public function report(){

    	return $this->belongsTo('App\Report');
    }
}
