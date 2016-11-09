<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\ControlAction;

// Namespace conflicting. I need to rename to "CA"
use App\ControlAction as CA;

class ControlActionController extends Controller
{
    
	public function add(Request $request){
		$controlAction = new CA();
		$controlAction->name = $request->input('name');
		$controlAction->description = "Description";
		$controlAction->controller_id = $request->input('controller_id');

		$controlAction->save();

		return response()->json([
			'id' => $controlAction->id,
        	'name' => $controlAction->name,
        	'controller_id' => $controlAction->controller_id
    	]);
	}

	public function delete(Request $request){
		CA::destroy($request->input('id'));
	}

}
