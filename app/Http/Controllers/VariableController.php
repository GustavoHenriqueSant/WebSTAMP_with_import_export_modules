<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Variable;

use App\State;

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

		return response()->json([
        	'name' => $variable->name,
        	'id' => $variable->id,
        	'controller_id' => $variable->controller_id,
        	'states' => $states
    	]);
	}

	public function delete(Request $request){
		Variable::destroy($request->input('id'));
	}

	public function edit(Request $request){
		$variable = Variable::find($request->input('id'));
		$variable->name = $request->input('name');
		$variable->save();
	}

}
