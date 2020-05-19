<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LossesHazards extends Model
{
	public function loss(){
		return $this->belongsTo(Losses::class);
	}

	public function hazard(){
		return $this->belongsTo(Hazards::class);
	}

}
