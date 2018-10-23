<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\CausalAnalysis;

class CausalAnalysisController extends Controller
{
    public function add(Request $request){
    	$causal = new CausalAnalysis();
    	$causal->scenario = $request->input('scenario');
    	$causal->associated_causal_factor = $request->input('associated');
    	$causal->requirement = $request->input('requirement');
    	// $causal->role = $request->input('role');
    	$causal->rationale = $request->input('rationale');
    	$causal->guideword_id = $request->input('guideword');
    	$causal->safety_constraint_id = $request->input('safety');
    	
    	$causal->save();

    	return response()->json([
    		'id' => $causal->id,
        	'scenario' => $causal->scenario,
        	'associated' => $causal->associated_causal_factor,
        	'requirement' => $causal->requirement,
        	// 'role' => $causal->role,
        	'rationale' => $causal->rationale,
        	'guideword' => $causal->guideword_id,
        	'safety_constraint_id' => $causal->safety_constraint_id
    	]);
		
    }

    public function delete(Request $request){
    	CausalAnalysis::destroy($request->input('id'));
    }

    public function deleteAll(Request $request) {
        CausalAnalysis::where("safety_constraint_id", $request->input('uca_id'))->delete();
    }

    public function edit(Request $request){
    	$causal = CausalAnalysis::find($request->input('id'));
    	$causal->scenario = $request->input('scenario');
    	$causal->associated_causal_factor = $request->input('associated');
    	$causal->requirement = $request->input('requirement');
    	// $causal->role = $request->input('role');
    	$causal->rationale = $request->input('rationale');
    	$causal->guideword_id = $request->input('guideword');
    	//$causal->safety_constraint_id = isset($request->input('safety')) ? isset($request->input('safety') : $causal->safety_constraint_id;
		$causal->save();
    }
}
