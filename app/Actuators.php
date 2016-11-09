<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Actuators extends Model
{
    public function project(){
		return $this->belongsTo(Projects::class);
	}

}
