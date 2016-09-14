<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rules extends Model
{

	public function project(){
		return $this->belongsTo(project::class);
	}

	public function controlAction(){
		return $this->belongsTo(ControlAction::class);
	}

}