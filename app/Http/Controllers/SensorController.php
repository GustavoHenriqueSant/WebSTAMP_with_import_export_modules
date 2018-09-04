<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Sensors;

class SensorController extends Controller
{

    public function add(Request $request){
    	$sensor = new Sensors();
    	$sensor->name = $request->input('name');
    	$sensor->project_id = $request->input('project_id');
    	$sensor->save();

    	return response()->json([
        	'name' => $sensor->name,
        	'id' => $sensor->id
    	]);

    }

    public function delete(Request $request){
    	Sensors::destroy($request->input('id'));
    }

    public function edit(Request $request){
    	$sensor = Sensors::find($request->input('id'));
		$sensor->name = $request->input('name');
		$sensor->save();
    }

}
