<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RulesSafetyConstraintsHazards extends Model
{
    protected $table = "rules_safetyconstraints_hazards";

    function rule(){
    	return $this->belongsTo('App\Rule');
    }

    function safetyConstraint(){
    	return $this->belongsTo('App\SafetyConstraints');
    }

    function hazard(){
    	return $this->belongsTo('App\Hazards');
    }
}
