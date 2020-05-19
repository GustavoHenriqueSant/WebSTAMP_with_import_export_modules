<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\LossesHazards;

class LossHazardController extends Controller
{
    public function add($loss_id, $hazard_id){
		$loss_hazard = new LossesHazards();
		$loss_hazard->loss_id = $loss_id;
		$loss_hazard->hazard_id = $hazard_id;
		$hazard->save();
	}

	public function delete(Request $request){
		LossesHazards::destroy($request->input('id'));
	}
}
