<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\ControlAction;

// Namespace conflicting. I need to rename to "CA"
use App\ControlAction as CA;

use Illuminate\Routing\Redirector;

class ControlActionController extends Controller
{
    
	public function add(Request $request){
		$controlAction = new CA();
		$controlAction->name = $request->get('controlaction-name');
		$controlAction->description = "Description";
		$controlAction->component_id = $request->get('controller-association');

		$controlAction->save();

		return redirect()->route('fundamentals');
	}

	public function delete(Request $request){
		
	}

}
