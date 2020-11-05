<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SystemSafetyConstraintHazards extends Model
{
	protected $table = 'systemSafetyConstraint_hazards';

	function systemSafetyConstraint(){
		return $this->belongsTo('App\systemSafetyConstraint');
	}

	function hazards(){
		return $this->belongsTo('App\Hazards');
	}
}
