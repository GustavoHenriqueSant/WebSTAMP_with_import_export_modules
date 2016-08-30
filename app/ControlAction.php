<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ControlAction extends Model
{
    public function component(){
		return $this->belongsTo(Components::class);
	}

}
