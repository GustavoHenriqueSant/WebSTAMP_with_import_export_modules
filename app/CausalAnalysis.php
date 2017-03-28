<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CausalAnalysis extends Model
{

	protected $table = 'causal_analysis';

    public function project(){
		return $this->belongsTo(Projects::class);
	}

}
