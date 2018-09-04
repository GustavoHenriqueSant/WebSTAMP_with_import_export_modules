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
		$component->project_id = $request->input('project_id');

		$component->save();

		return response()->json([
        	'name' => $component->name,
        	'type' => $component->type,
        	'id' => $component->id
    	]);
	}

	public function delete(Request $request){
		Components::destroy($request->input('id'));
	}

}
