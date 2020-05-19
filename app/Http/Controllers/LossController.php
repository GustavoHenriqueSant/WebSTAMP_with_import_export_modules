<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Losses;

use App\LossesHazards;

use Illuminate\Routing\Redirector;

class LossController extends Controller
{
    
	public function add(Request $request){
		$loss = new Losses();
		$loss->name = $request->input('name');
		$loss->description = "Teste";
		$loss->project_id = $request->input('project_id');

		$loss->save();

		// $loss_map[$loss->id] = count($loss_map) + 1;

		return response()->json([
        	'name' => $loss->name,
        	'id' => $loss->id
    	]);
	}

	public function delete(Request $request){

		$id = $request->input('id');

		$lossesHazards = LossesHazards::where("losses_id",$id)->get();
		foreach($lossesHazards as $lossHazard){
			LossesHazards::destroy($lossHazard->id);
		}

		Losses::destroy($id);

		
	}
	

	public function edit(Request $request){
		$loss =Losses::find($request->input('id'));
		$loss->name = $request->input('name');
		$loss->save();
	}

}
