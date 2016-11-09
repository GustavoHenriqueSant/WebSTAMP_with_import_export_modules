<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sensors extends Model
{
    public function project(){
		return $this->belongsTo(Projects::class);
	}

}
