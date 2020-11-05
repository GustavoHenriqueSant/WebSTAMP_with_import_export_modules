<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Assumptions;

use Illuminate\Routing\Redirector;

class AssumptionsController extends Controller
{
    
	public function add(Request $request){
		$assumption = new Assumptions();
		$assumption->name = $request->input('name');
		$assumption->description = "Teste";
		$assumption->project_id = $request->input('project_id');

		$assumption->save();

		return response()->json([
	        	'name' => $assumption->name,
	        	'id' => $assumption->id
    		]);
	}

	public function delete(Request $request){
		Assumptions::destroy($request->input('id'));
	}

	public function edit(Request $request){
		$assumption = Assumptions::find($request->input('id'));
		$assumption->name = $request->input('name');
		$assumption->save();
	}

	public function getText(Request $request){
		$assumption = Assumptions::find($request->input('id'));
		return response()->json([
	        	'name' => $assumption->name
    		]);
	}

}
