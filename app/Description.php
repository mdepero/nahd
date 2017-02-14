<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Description extends Model
{
    
    public function area(){

    	return $this->belongsTo('App\FDescriptionArea', 'area_id');
    }

    public function section(){

    	return $this->belongsTo('App\Section');
    }
}
