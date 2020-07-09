<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rule extends Model
{
	public function controlAction(){
		return $this->belongsTo(ControlAction::class);
	}

	public function variables(){
		return $this->hasMany('App\RulesVariables');
	}
}