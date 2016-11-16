<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Variable;

use App\State;

use App\Rules;

use App\Controllers;

use App\ControlAction as CA;

use Illuminate\Routing\Redirector;

class VariableController extends Controller
{

    public function add(Request $request){
		$variable = new Variable();
		$variable->controller_id = $request->input('controller_id');
		$variable->name = $request->input('name');
		$variable->project_id = 1;

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
				foreach(Rules::distinct()->select('index')->where('controlaction_id', $control_action->id)->get() as $rules) {
					$rule = new Rules();
					$rule->index = $rules->index;
					$rule->state_id = 0;
					$rule->controlaction_id = $control_action->id;
					$rule->save();
				}
			}
		} else {
			foreach(Controllers::where('project_id', 1)->get() as $controller) {
				foreach(CA::where('controller_id', $controller->id)->get() as $control_action) {
					foreach(Rules::distinct()->select('index')->where('controlaction_id', $control_action->id)->get() as $rules) {
						$rule = new Rules();
						$rule->index = $rules->index;
						$rule->variable_id = $variable->id;
						$rule->state_id = 0;
						$rule->controlaction_id = $control_action->id;
						$rule->save();
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
		Rules::where('variable_id', $request->input('id'))->delete();
		Variable::destroy($request->input('id'));
	}

	public function edit(Request $request){
		$variable = Variable::find($request->input('id'));
		$variable->name = $request->input('name');
		$variable->save();
	}

}
