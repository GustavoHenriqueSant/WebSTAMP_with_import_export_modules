<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Variable;

use App\State;

use App\Rule;

use App\RulesVariablesStates;

use App\Controllers;

use App\ControlAction as CA;

use DB;

use Illuminate\Routing\Redirector;

class VariableController extends Controller
{

    public function add(Request $request){
		$variable = new Variable();
		$variable->controller_id = $request->input('controller_id');
		$variable->name = $request->input('name');
		$variable->project_id = $request->input('project_id');

		$variable->save();

		$states_name = $request->input('states');
		$states = [];


		foreach($states_name as $state_name) {
			$state = new State();
			$state->name = $state_name;
			$state->variable_id = $variable->id;
			$state->save();
			array_push($states, $state);
		}

		if ($variable->controller_id > 0){
			foreach(CA::where('controller_id', $variable->controller_id)->get() as $control_action) {
				foreach(Rule::distinct()->select('id')->where('controlaction_id', $control_action->id)->get() as $rule) {
					$rule_variable = new RulesVariablesStates();
					$rule_variable->rule_id = $rule->id;
					$rule_variable->variable_id = $variable->id;
					$rule_variable->state_id = 0;
					$rule_variable->save();
				}
			}
		} else {
			foreach(Controllers::where('project_id', $variable->project_id)->get() as $controller) {
				foreach(CA::where('controller_id', $controller->id)->get() as $control_action) {
					foreach(Rule::distinct()->select('id')->where('controlaction_id', $control_action->id)->get() as $rule) {
						$rule_variable = new RulesVariablesStates();
						$rule_variable->rule_id = $rule->id;
						$rule_variable->variable_id = $variable->id;
						$rule_variable->state_id = 0;
						$rule_variable->save();
					}
				}
			}
		}

		return response()->json([
	        	'name' => $variable->name,
	        	'id' => $variable->id,
	        	'controller_id' => $variable->controller_id,
	        	'states' => $states
    		]);
	}

	public function delete(Request $request){
		RulesVariablesStates::where('variable_id', $request->input('id'))->delete();
		$states = State::where('variable_id', $request->input('id'))->get();
		foreach($states as $state) {
			DB::select(DB::raw("UPDATE context_tables SET context = REPLACE(context, ',".$state->id.",', ',') WHERE context like '%,".$state->id.",%'"));
			DB::select(DB::raw("UPDATE context_tables SET context = REPLACE(context, ',".$state->id."', '') WHERE context like '%,".$state->id."'"));
			DB::select(DB::raw("UPDATE context_tables SET context = REPLACE(context, '".$state->id.",', '') WHERE context like '".$state->id.",%'"));
			State::destroy($state->id);			
		}
		Variable::destroy($request->input('id'));
	}

	public function edit(Request $request){
		$variable = Variable::find($request->input('id'));
		$variable->name = $request->input('name');
		$variable->save();
	}

}
