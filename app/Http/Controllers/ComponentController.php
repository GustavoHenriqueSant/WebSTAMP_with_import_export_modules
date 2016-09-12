<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Components;

use Illuminate\Routing\Redirector;

class ComponentController extends Controller
{

    public function add(Request $request){
		$component = new Components();
		$component->name = $request->input('name');
		$component->type = $request->input('type');
		$component->project_id = 1;

		$component->save();

		return response()->json([
        	'name' => $request->input('name'),
        	'type' => $request->input('type'),
        	'id' => $request->input('id')
    	]);
	}

	public function delete(Request $request){
		
	}

}
