<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Hazards;

use App\Accidents_Hazards;

use Illuminate\Routing\Redirector;

class HazardController extends Controller
{
    
	public function add(Request $request){
		$hazard = new Hazards();
		$hazard->name = $request->get('hazard-name');
		$hazard->description = "Teste";
		$hazard->project_id = $request->get('project_id');

		$hazard->save();

		return redirect()->route('fundamentals');
	}

	public function delete(Request $request){
		
	}

}
