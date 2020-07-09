<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RulesVariables extends Model
{
	protected $table = "rules_variables";

	public function rule(){
		return $this->belongsTo('App\Rule');
	}

	public function variable(){
		return $this->belongsTo('App\Variable');
	}

	public function state(){
		return $this->belongsTo('App\State');
	}
}
