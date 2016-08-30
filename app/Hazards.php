<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hazards extends Model
{
    public function project(){
		return $this->belongsTo(Projects::class);
	}

	public function accidentshazards(){
		return $this->hasMany(Accidents_Hazards::class);
	}

}
