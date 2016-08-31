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
		$state->name = $request->get('state-name');
		$state->variable_id = $request->get('variable-association');

		$state->save();

		return redirect()->route('fundamentals');
	}

	public function delete(Request $request){
		
	}

}
