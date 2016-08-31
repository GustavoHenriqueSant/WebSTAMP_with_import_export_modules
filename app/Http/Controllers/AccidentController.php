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
		$accident->name = $request->get('accident-name');
		$accident->description = "Teste";
		$accident->project_id = $request->get('project_id');

		$accident->save();

		return redirect()->route('fundamentals');
	}

	public function delete(Request $request){
		App\Accidents::destroy($request->get("accident_id"));
	}

}
