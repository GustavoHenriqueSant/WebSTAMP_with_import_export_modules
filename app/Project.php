<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    public function actuators(){
        return $this->hasMany(Actuators::class);
    }

    public function assumptions(){
        return $this->hasMany(Assumptions::class);
    }

    public function components(){
        return $this->hasMany(Components::class);
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

    public function sensor(){
        return $this->hasMany(Sensors::class);
    }

    public function systemGoals(){
        return $this->hasMany(SystemGoals::class);
    }

    public function ssc(){
        return $this->hasMany(SystemSafetyConstraints::class);
    }
}
