<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Assumptions extends Model
{
    public function project(){
		return $this->belongsTo(Projects::class);
	}
}
