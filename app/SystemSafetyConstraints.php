<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SystemSafetyConstraints extends Model
{

	protected $table = 'system_safety_constraint';

    	public function project(){
		return $this->belongsTo(Projects::class);
	}

	public function hazards(){
		return $this->belongsTo('App\SystemSafetyConstraintHazards');
	}
}