<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Hazards;

use App\LossesHazards;

use App\RulesSafetyConstraintsHazards;

use App\SystemSafetyConstraintHazards;

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

		foreach($losses as $loss_id){
			$loss_associated = new LossesHazards();
			$loss_associated->loss_id = $loss_id;
			$loss_associated->hazard_id = $hazard->id;
			$loss_associated->save();
		}
		
		return response()->json([
        	'name' => $hazard->name,
        	'id' => $hazard->id,
        	'losses_associated' => $losses,
        	'project_type' => $request->input('project_type')
    	]);
	}

	public function delete(Request $request){
		Hazards::destroy($request->input('id'));
		LossesHazards::where('hazard_id', $request->input('id'))->delete();
		RulesSafetyConstraintsHazards::where('hazard_id', $request->input('id'))->delete();
		SystemSafetyConstraintHazards::where('hazard_id', $request->input('id'))->delete();
	}

	public function edit(Request $request){
		$hazard = Hazards::find($request->input('id'));
		$hazard->name = $request->input('name');
		$hazard->save();
		$losses_ids = $request->input('losses_ids');
		LossesHazards::where('hazard_id',$request->input('id'))->delete();

		foreach ($losses_ids as $loss_id) {
			$losses_hazards = new LossesHazards();
			$losses_hazards->hazard_id = $request->input('id');
			$losses_hazards->loss_id = $loss_id;
			$losses_hazards->save();
		}
	}

	public function getText(Request $request){
		$hazard = Hazards::find($request->input('id'));
		return response()->json([
	        	'name' => $hazard->name
    		]);
	}

}
