<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Accidents;

use Illuminate\Routing\Redirector;

class AccidentController extends Controller
{
    
	public function add(Request $request){
		$accident = new Accidents();
		$accident->name = $request->input('name');
		$accident->description = "Teste";
		$accident->project_id = 1;

		$accident->save();

		return response()->json([
        	'name' => $request->input('name'),
        	'id' => $request->input('id')
    	]);
	}

	public function delete(Request $request){
		App\Accidents::destroy($request->get("accident_id"));
	}

}
