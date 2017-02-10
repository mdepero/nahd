<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{

	protected $guarded = ['access_key'];
    
    public function sections(){

    	return $this->hasMany('App\Section');
    }
}
