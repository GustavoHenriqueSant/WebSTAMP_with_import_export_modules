<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Losses extends Model
{

	public function project(){
		return $this->belongsTo(Projects::class);
	}

	public function accidentshazards(){
		return  $this->hasMany(LossesHazards::class);
	}

}
