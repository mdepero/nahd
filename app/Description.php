<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Description extends Model
{
    
    public function area(){

    	$this->belongsTo('App\FDescriptionArea');
    }

    public function section(){

    	$this->belongsTo('App\Section');
    }
}
