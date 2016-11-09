<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ControlAction extends Model
{
    public function controller(){
		return $this->belongsTo(Controllers::class);
	}

}
