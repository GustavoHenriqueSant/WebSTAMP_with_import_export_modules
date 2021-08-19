<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SafetyConstraints extends Model
{
	protected $table = 'safety_constraints';

    public function controlaction(){
		return $this->belongsTo(ControlAction::class);
	}

	public function rule(){
		return $this->belongsTo(Rule::class);
	}

	public function causalAnalysis(){
		return $this->hasMany(CausalAnalysis::class, "safety_constraint_id");
	}

	public function rulesSafetyConstraintsHazards(){
		return $this->hasMany(RulesSafetyConstraintsHazards::class, "sc_id");
	}
}