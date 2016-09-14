<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AccidentsHazards extends Model
{
	public function accident(){
		return $this->belongsTo(Accidents::class);
	}

	public function hazard(){
		return $this->belongsTo(Hazards::class);
	}

}
