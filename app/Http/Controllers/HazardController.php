<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Hazards;

use App\AccidentsHazards;

use Illuminate\Routing\Redirector;

class HazardController extends Controller
{
    
	public function add(Request $request){

		$hazard = new Hazards();
		$hazard->name = $request->input('name');
		$hazard->description = "Teste";
		$hazard->project_id = 1;

		$hazard->save();

		$accidents = $request->input('accidents_associated');

		foreach($accidents as $accident_id){
			$accident_associated = new AccidentsHazards();
			$accident_associated->accidents_id = $accident_id;
			$accident_associated->hazards_id = $hazard->id;
			$accident_associated->save();
		}

		return response()->json([
        	'name' => $hazard->name,
        	'id' => $hazard->id,
        	'accidents_associated' => $accidents
    	]);
	}

	public function delete(Request $request){
		Hazards::destroy($request->input('id'));
	}

	public function edit(Request $request){
		$hazard = Hazards::find($request->input('id'));
		$hazard->name = $request->input('name');
		$hazard->save();
	}

}
