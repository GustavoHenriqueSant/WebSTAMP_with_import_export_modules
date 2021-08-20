<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Controllers extends Model
{
    public function project(){
		return $this->belongsTo(Projects::class);
	}

	public function controlaction(){
		return $this->hasMany(ControlAction::class, "controller_id");
	}

	public function variables(){
		return $this->hasMany(Variable::class, "controller_id");
	}

}
