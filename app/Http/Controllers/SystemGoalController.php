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
		$systemGoals->project_id = $request->input('project_id');

		$systemGoals->save();

		return response()->json([
        	'name' => $systemGoals->name,
        	'id' => $systemGoals->id
    	]);
	}

	public function delete(Request $request){
		SystemGoals::destroy($request->input('id'));
	}

	public function edit(Request $request){
		$systemGoal = SystemGoals::find($request->input('id'));
		$systemGoal->name = $request->input('name');
		$systemGoal->save();
	}

	public function getText(Request $request){
		$systemGoal = SystemGoals::find($request->input('id'));
		return response()->json([
	        	'name' => $systemGoal->name
    		]);
	}


}
