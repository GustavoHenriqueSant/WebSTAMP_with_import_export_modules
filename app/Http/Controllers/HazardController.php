<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Hazards;

// use App\AccidentsHazards;

use Illuminate\Routing\Redirector;

class HazardController extends Controller
{
    
	public function add(Request $request){
		$hazard = new Hazards();
		$hazard->name = $request->input('name');
		$hazard->description = "Teste";
		$hazard->project_id = 1;

		$hazard->save();

		return response()->json([
        	'name' => $hazard->name,
        	'id' => $hazard->id
    	]);
	}

	public function delete(Request $request){
		
	}

}
