<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Connections;

class ConnectionController extends Controller
{
    
	public function add(Request $request){
		$connection = new Connections();
		$connection->output_component_id = $request->input('output_component_id');
		$connection->type_output = $request->input('type_output');
		$connection->input_component_id = $request->input('input_component_id');
		$connection->type_input = $request->input('type_input');

		$connection->save();
		return response()->json([
        	'output_component_id' => $connection->output_component_id,
        	'output_name' => $request->input('output_name'),
        	'type_output' => $connection->type_output,
        	'input_component_id' => $connection->input_component_id,
        	'type_input' => $connection->type_input,
        	'input_name' => $request->input('input_name'),
        	'output_name' => $request->input('output_name'),
        	'id' => $connection->id
    	]);
	}

	public function delete(Request $request) {
		Connections::destroy($request->input('id'));
	}

}
