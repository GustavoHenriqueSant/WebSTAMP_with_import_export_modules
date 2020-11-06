<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rule extends Model
{
	protected $primaryKey = 'id';

	public function controlAction(){
		return $this->belongsTo(ControlAction::class);
	}

	public function variables(){
		return $this->hasMany('App\RulesVariablesStates');
	}

	public function hazards(){
		return $this->hasMany('App\RulesSafetyConstraintsHazards');
	}
}