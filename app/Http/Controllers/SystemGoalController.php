<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\SystemGoals;

use Illuminate\Routing\Redirector;

class SystemGoalController extends Controller
{
    
	public function add(Request $request){
		$systemGoals = new SystemGoals();
		$systemGoals->name = $request->input('name');
		$systemGoals->description = "Teste";
		$systemGoals->project_id = 1;

		$systemGoals->save();

		return response()->json([
        	'name' => $request->input('name'),
        	'id' => $request->input('id')
    	]);
	}

	public function delete(Request $request){
		
	}


}
