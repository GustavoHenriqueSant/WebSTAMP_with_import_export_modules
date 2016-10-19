<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\AccidentsHazards;

class AccidentHazardController extends Controller
{
    public function add($accident_id, $hazard_id){
		$accident_hazard = new AccidentsHazards();
		$accident_hazard->accident_id = $accident_id;
		$accident_hazard->hazard_id = $hazard_id;
		$hazard->save();
	}

	public function delete(Request $request){
		AccidentsHazards::destroy($request->input('id'));
	}
}
