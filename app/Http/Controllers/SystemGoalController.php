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
		$systemGoals->name = $request->get('systemgoals-name');
		$systemGoals->description = "Teste";
		$systemGoals->project_id = $request->get('project_id');

		$systemGoals->save();

		return redirect()->route('fundamentals');
	}

	public function delete(Request $request){
		
	}


}
