<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    public function section(){

    	return $this->belongsTo('App\Report');
    }
}
