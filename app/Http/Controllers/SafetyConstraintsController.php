<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\SafetyConstraints;

class SafetyConstraintsController extends Controller
{
    
	public function add(Request $request){
		$safety_constraint = new SafetyConstraints();
		$safety_constraint->unsafe_control_action = $request->input('unsafe_control_action');
		$safety_constraint->safety_constraint = $request->input('safety_constraint');
		$safety_constraint->type = $request->input('type');
		$safety_constraint->controlaction_id = $request->input('controlaction_id');
		$safety_constraint->rule_id = $request->input('rule_id');
		$safety_constraint->context = $request->input('context');

		$safety_constraint->save();

		return response()->json([
			'id' => $safety_constraint->id,
        	'unsafe_control_action' => $safety_constraint->unsafe_control_action,
        	'safety_constraint' => $safety_constraint->safety_constraint,
        	'type' => $safety_constraint->type,
        	'controlaction_id' => $safety_constraint->controlaction_id,
        	'rule_id' => $safety_constraint->rule_id,
        	'context' => $safety_constraint->context
    	]);

	}

	public function edit(Request $request){
		$safety_constraint = SafetyConstraints::find($request->input('id'));
		$safety_constraint->unsafe_control_action = $request->input('unsafe_control_action');
		$safety_constraint->safety_constraint = $request->input('safety_constraint');
		$safety_constraint->type = $request->input('type');
		$safety_constraint->save();
	}

	public function delete(Request $request){
		SafetyConstraints::destroy($request->input('id'));
	}

	public function deleteAll(Request $request){
		SafetyConstraints::where('controlaction_id', $request->input('controlaction_id'))->where('rule_id', 0)->delete();
	}
}
