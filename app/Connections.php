<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Connections extends Model
{
    public function project(){
		return $this->belongsTo(Project::class);
	}

	public function controllers(){
		return $this->belongsTo(Controllers::class);
	}

	public function actuators(){
		return $this->belongsTo(Actuators::class);
	}

	public function controlledprocess(){
		return $this->belongsTo(ControlledProcess::class);
	}

	public function sensors(){
		return $this->belongsTo(Sensors::class);
	}

}
