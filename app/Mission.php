<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mission extends Model
{

	protected $table = 'mission';

    	public function project(){
		return $this->belongsTo(Projects::class);
	}

}