<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CausalAnalysis extends Model
{

	protected $table = 'causal_analysis';

	public function guideword(){
		return $this->belongsTo(Guidewords::class);
	}

	/*teste*/

}
