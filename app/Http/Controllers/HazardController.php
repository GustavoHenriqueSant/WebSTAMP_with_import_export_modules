<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Hazards;

use App\LossesHazards;

use Illuminate\Routing\Redirector;

class HazardController extends Controller
{
    
	public function add(Request $request){

		$hazard = new Hazards();
		$hazard->name = $request->input('name');
		$hazard->description = "Teste";
		$hazard->project_id = $request->input('project_id');

		$hazard->save();
		
		$losses = $request->input('losses_associated');
		$losses_associated_id = array();

		foreach($losses as $loss_id){
			$loss_associated = new LossesHazards();
			$loss_associated->losses_id = $loss_id;
			$loss_associated->hazards_id = $hazard->id;
			$loss_associated->save();
			array_push($losses_associated_id, $loss_associated->id);
		}
		
		return response()->json([
        	'name' => $hazard->name,
        	'id' => $hazard->id,
        	'losses_associated' => $losses,
        	'losses_associated_id' => $losses_associated_id,
        	'project_type' => $request->input('project_type')
    	]);
	}

	public function delete(Request $request){
		Hazards::destroy($request->input('id'));
	}

	public function edit(Request $request){
		$hazard = Hazards::find($request->input('id'));
		$hazard->name = $request->input('name');
		$hazard->save();
	}

}
