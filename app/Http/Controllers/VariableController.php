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
		$variable->name = $request->input('name');
		$variable->project_id = 1;

		$variable->save();

		return response()->json([
        	'name' => $variable->name,
        	'id' => $variable->id
    	]);
	}

	public function delete(Request $request){
		
	}

}
