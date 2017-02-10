<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FSection extends Model
{
    
    public function concern_areas(){

    	return $this->hasMany('App\FConcernArea');
    }

    public function description_areas(){

    	return $this->hasMany('App\FDescriptionArea');
    }
}
