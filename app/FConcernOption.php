<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FConcernOption extends Model
{
    
    public function area(){

    	return $this->belongsTo('App\FConcernArea');
    }
}
