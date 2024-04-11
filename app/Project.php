<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    public function actuators(){
        return $this->hasMany(Actuators::class);
    }

    public function variables(){
        return $this->hasMany(Variable::class);
    }

    public function assumptions(){
        return $this->hasMany(Assumptions::class);
    }

    public function controlledProcess(){
        return $this->hasOne(ControlledProcess::class);
    }

    public function controllers(){
        return $this->hasMany(Controllers::class);
    }

    public function hazards(){
        return $this->hasMany(Hazards::class);
    }

    public function losses(){
        return $this->hasMany(Losses::class);
    }

    public function missions(){
        return $this->hasMany(Mission::class);
    }

    public function sensors(){
        return $this->hasMany(Sensors::class);
    }

    public function systemGoals(){
        return $this->hasMany(SystemGoals::class);
    }

    public function systemSafetyConstraints(){
        return $this->hasMany(SystemSafetyConstraints::class);
    }
}