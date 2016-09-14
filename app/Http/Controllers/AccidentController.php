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
		//$teste = Accidents::where('name', $accident->name)->last();

		return response()->json([
        	'name' => $accident->name,
        	'id' => $accident->id
    	]);
	}

	public function delete(Request $request){
		Accidents::destroy($request->input('id'));
	}

}
