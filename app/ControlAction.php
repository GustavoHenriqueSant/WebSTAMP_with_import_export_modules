<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ControlAction extends Model
{
    public function controller(){
		return $this->belongsTo(Controllers::class);
	}

	public function rules(){
		return $this->hasMany(Rule::class, "controlaction_id");
	}

	public function contextTables(){
		return $this->hasMany(ContextTable::class, "controlaction_id");
	}

	public function safetyConstraints(){
		return $this->hasMany(SafetyConstraints::class, "controlaction_id");
	}
}