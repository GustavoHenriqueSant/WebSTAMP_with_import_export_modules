<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\RulesSafetyConstraintsHazards;

use App\SafetyConstraints;

use App\Rule;

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
		$safety_constraint->flag = 0;

		$safety_constraint->save();

		$hazards = $request->input('hazards_ids');

		for($i = 0; $i < sizeof($hazards); $i++){

			$rule_sc_hazard = new RulesSafetyConstraintsHazards();
			$rule_sc_hazard->rule_id = $request->input('rule_id');
			$rule_sc_hazard->sc_id = $safety_constraint->id;
			$rule_sc_hazard->hazard_id = $hazards[$i];
			$rule_sc_hazard->save();

		}

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

	public function editByRule(Request $request){
		$rule_id = $request->input('rule_id');
		$type = $request->input('type');

		$safety_constraint = SafetyConstraints::where('rule_id', $rule_id)->where('type', $type)->first();

		if(!$safety_constraint)
			$safety_constraint = new SafetyConstraints();
		

		$safety_constraint->rule_id = $rule_id;
		$safety_constraint->controlaction_id = $request->input('controlaction_id');
		$safety_constraint->unsafe_control_action = $request->input('unsafe_control_action');
		$safety_constraint->safety_constraint = $request->input('safety_constraint');
		$safety_constraint->type = $type;
		$safety_constraint->context = $request->input('context');

		$safety_constraint->save();

		RulesSafetyConstraintsHazards::where('rule_id', $rule_id)->where('sc_id', $safety_constraint->id)->delete();

		$hazards = $request->input('hazards_ids');

		for($i = 0; $i < sizeof($hazards); $i++){

			$rule_sc_hazard = new RulesSafetyConstraintsHazards();
			$rule_sc_hazard->rule_id = $rule_id;
			$rule_sc_hazard->sc_id = $safety_constraint->id;
			$rule_sc_hazard->hazard_id = $hazards[$i];
			$rule_sc_hazard->save();

		}

		return response()->json($safety_constraint);
		
	}

	public function refreshUcasWithRules(Request $request){
		$rule = Rule::where('id', $request->input('rule_id'))->first();

		$columns = explode(";" , $rule->column);

		$safety_constraints = SafetyConstraints::where('rule_id', $rule->id)->get();

		

		foreach($safety_constraints as $safety_constraint){
			if(!in_array($safety_constraint->type, $columns)){
				RulesSafetyConstraintsHazards::where('rule_id', $rule->id)->where('sc_id', $safety_constraint->id)->delete();
				$safety_constraint->delete();
			}
		}
	}

	public function getSafetyConstraint(Request $request){
		$safety_constraint = SafetyConstraints::find($request->input('sc_id'));
		$hazards = RulesSafetyConstraintsHazards::where('sc_id', $safety_constraint->id)->get(['hazard_id']);

		return response()->json([
			'uca' => $safety_constraint->unsafe_control_action,
	        	'sc' => $safety_constraint->safety_constraint,
			'type' => $safety_constraint->type,
			'context' => $safety_constraint->context,
			'hazards' => $hazards,
			'flag' => $safety_constraint->flag
		]);

	}

	public function edit(Request $request){
		$safety_constraint = SafetyConstraints::find($request->input('id'));
		$safety_constraint->unsafe_control_action = $request->input('unsafe_control_action');
		$safety_constraint->safety_constraint = $request->input('safety_constraint');
		$safety_constraint->type = $request->input('type');
		$safety_constraint->context = $request->input('context');
		$safety_constraint->flag = $request->input('flag');
		$safety_constraint->save();

		RulesSafetyConstraintsHazards::where('sc_id', $safety_constraint->id)->delete();

		$hazards = $request->input('hazards_ids');

		for($i = 0; $i < sizeof($hazards); $i++){

			$rule_sc_hazard = new RulesSafetyConstraintsHazards();
			$rule_sc_hazard->rule_id = 0;
			$rule_sc_hazard->sc_id = $safety_constraint->id;
			$rule_sc_hazard->hazard_id = $hazards[$i];
			$rule_sc_hazard->save();

		}
	}

	public function delete(Request $request){
		SafetyConstraints::destroy($request->input('id'));
		RulesSafetyConstraintsHazards::where('sc_id', $request->input('id'))->delete();
	}

	public function deleteAll(Request $request){
		$safety_constraints = SafetyConstraints::where('controlaction_id', $request->input('controlaction_id'))->where('rule_id', 0)->get();

		foreach($safety_constraints as $sc){
			RulesSafetyConstraintsHazards::where('sc_id', $sc->id)->delete();
			$sc->delete();
		}
		
	}
}
