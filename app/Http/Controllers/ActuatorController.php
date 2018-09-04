<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Actuators;

class ActuatorController extends Controller
{
    
	public function add(Request $request){
    	$actuator = new Actuators();
    	$actuator->name = $request->input('name');
    	$actuator->project_id = $request->input('project_id');
    	$actuator->save();

    	return response()->json([
        	'name' => $actuator->name,
        	'id' => $actuator->id
    	]);

    }

    public function delete(Request $request){
    	Actuators::destroy($request->input('id'));
    }

    public function edit(Request $request){
    	$actuator = Actuators::find($request->input('id'));
		$actuator->name = $request->input('name');
		$actuator->save();
    }

}
