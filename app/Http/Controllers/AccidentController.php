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
		$accident->project_id = $request->input('project_id');

		$accident->save();

		// $accident_map[$accident->id] = count($accident_map) + 1;

		return response()->json([
        	'name' => $accident->name,
        	'id' => $accident->id
    	]);
	}

	public function delete(Request $request){
		Accidents::destroy($request->input('id'));
	}

	public function edit(Request $request){
		$accident = Accidents::find($request->input('id'));
		$accident->name = $request->input('name');
		$accident->save();
	}

}
