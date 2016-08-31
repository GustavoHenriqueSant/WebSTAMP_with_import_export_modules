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
		$component->name = $request->get('component-name');
		$component->type = $request->get('component-type');
		$component->project_id = $request->get('project_id');

		$component->save();

		return redirect()->route('fundamentals');
	}

	public function delete(Request $request){
		
	}

}
