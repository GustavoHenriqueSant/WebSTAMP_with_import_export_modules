<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Controllers;

class ControllerController extends Controller
{
    public function add(Request $request){
    	$controller = new Controllers();
    	$controller->name = $request->input('name');
    	$controller->project_id = $request->input('project_id');
    	$controller->save();

    	return response()->json([
        	'name' => $controller->name,
        	'id' => $controller->id
    	]);

    }

    public function delete(Request $request){
    	Controllers::destroy($request->input('id'));
    }

    public function edit(Request $request){
    	$controller = Controllers::find($request->input('id'));
		$controller->name = $request->input('name');
		$controller->save();
    }
    
}
