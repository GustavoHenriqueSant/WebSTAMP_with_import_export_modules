<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Accidents;

class AccidentController extends Controller
{
    
	public function send(Request $request){
		$accident = new Accidents();
		$accident->name = $request->get('accident-name');
		$accident->description = "Teste";
		$accident->project_id = $request->get('project_id');

		$accident->save();
	}

}
