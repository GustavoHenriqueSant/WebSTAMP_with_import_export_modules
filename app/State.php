<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    public function variable(){
		return $this->belongsTo(Variable::class);
	}

}
