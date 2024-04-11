<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hazards extends Model
{

	protected $table = 'hazards';

    public function project(){
		return $this->belongsTo(Projects::class);
	}

	public function losseshazardsRelations(){
		return $this->hasMany(LossesHazards::class, "hazard_id");
	}

}
