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

}