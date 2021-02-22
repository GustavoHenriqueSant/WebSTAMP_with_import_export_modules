<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\SystemSafetyConstraints;

use App\SystemSafetyConstraintHazards;

use Illuminate\Routing\Redirector;

class SystemSafetyConstraintController extends Controller
{
    
	public function add(Request $request){
		$sys_safety_contraint = new SystemSafetyConstraints();
		$sys_safety_contraint->name = $request->input('name');
		$sys_safety_contraint->description = "Teste";
		$sys_safety_contraint->project_id = $request->input('project_id');

		$sys_safety_contraint->save();

		$hazards_ids = $request->input('hazards_ids');

		foreach ($hazards_ids as $hazard_id) {
			$sys_safety_contraint_hazards = new SystemSafetyConstraintHazards();
			$sys_safety_contraint_hazards->ssc_id = $sys_safety_contraint->id;
			$sys_safety_contraint_hazards->hazard_id = $hazard_id;
			$sys_safety_contraint_hazards->save();
		}

		return response()->json([
	        	'name' => $sys_safety_contraint->name,
	        	'id' => $sys_safety_contraint->id
    		]);
	}

	public function delete(Request $request){
		SystemSafetyConstraints::destroy($request->input('id'));
		SystemSafetyConstraintHazards::where('ssc_id', $request->input('id'))->delete();
	}

	public function edit(Request $request) {
		$sys_safety_contraint = SystemSafetyConstraints::find($request->input('id'));
		$sys_safety_contraint->name = $request->input('name');
		$sys_safety_contraint->save();
		$hazards_ids = $request->input('hazards_ids');
		SystemSafetyConstraintHazards::where('ssc_id',$request->input('id'))->delete();

		foreach ($hazards_ids as $hazard_id) {
			$sys_safety_contraint_hazards = new SystemSafetyConstraintHazards();
			$sys_safety_contraint_hazards->ssc_id = $request->input('id');
			$sys_safety_contraint_hazards->hazard_id = $hazard_id;
			$sys_safety_contraint_hazards->save();
		}
	}

	public function getText(Request $request){
		$ssc = SystemSafetyConstraints::find($request->input('id'));
		return response()->json([
	        	'name' => $ssc->name
    		]);
	}

}