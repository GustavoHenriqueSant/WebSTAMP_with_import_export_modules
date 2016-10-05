<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\State;

use Illuminate\Routing\Redirector;

class StateController extends Controller
{

    public function add(Request $request){
		$state = new State();
		$state->name = $request->input('name');
		$state->variable_id = $request->input('variable_id');

		$state->save();

		return response()->json([
			'id' => $state->id,
        	'name' => $state->name,
        	'variable_id' => $state->variable_id
    	]);
	}

	public function delete(Request $request){
		State::destroy($request->input('id'));
	}

}
