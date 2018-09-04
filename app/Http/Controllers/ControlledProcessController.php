<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\ControlledProcess;

class ControlledProcessController extends Controller
{
    
	public function add(Request $request){
    	$controlled_process = new ControlledProcess();
    	$controlled_process->name = $request->input('name');
    	$controlled_process->project_id = $request->input('project_id');
    	$controlled_process->save();

    	return response()->json([
        	'name' => $controlled_process->name,
        	'id' => $controlled_process->id
    	]);

    }

    public function delete(Request $request){
    	ControlledProcess::destroy($request->input('id'));
    }

    public function edit(Request $request){
    	$controlled_process = ControlledProcess::find($request->input('id'));
		$controlled_process->name = $request->input('name');
		$controlled_process->save();
    }

}
