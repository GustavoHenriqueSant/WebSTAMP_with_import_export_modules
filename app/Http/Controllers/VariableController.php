<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Variable;

use Illuminate\Routing\Redirector;

class VariableController extends Controller
{

    public function add(Request $request){
		$variable = new Variable();
		$variable->name = $request->get('variable-name');
		$variable->project_id = $request->get('project_id');

		$variable->save();

		return redirect()->route('fundamentals');
	}

	public function delete(Request $request){
		
	}

}
