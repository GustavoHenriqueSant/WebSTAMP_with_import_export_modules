<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Mission;

use Illuminate\Routing\Redirector;

class MissionController extends Controller
{
    
	public function add(Request $request){
		$mission = new Mission();
		$mission->purpose = $request->input('purpose');
		$mission->method = $request->input('method');
		$mission->goals = $request->input('goals');
		$mission->project_id = $request->input('project_id');

		$mission->save();

		return response()->json([
        	'purpose' => $mission->purpose,
        	'method' => $mission->method,
        	'goals' => $mission->goals,
        	'id' => $mission->id
    	]);
	}

	public function delete(Request $request){
		Mission::destroy($request->input('id'));
	}

	public function edit(Request $request) {
		$mission = Mission::find($request->get('id'));
		$mission->purpose = $request->get('purpose');
		$mission->method = $request->get('method');
		$mission->goals = $request->get('goals');
		$mission->save();
	}

}