<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FDescriptionOption extends Model
{
    
    public function area(){

    	return $this->belongsTo('App\FDescriptionArea');
    }
}
