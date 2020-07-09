<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Rule;

use App\RulesVariables;

use App\SafetyConstraints;

use Illuminate\Routing\Redirector;

use Illuminate\Http\RedirectResponse;

class RuleController extends Controller
{
    
	public function add(Request $request){
		$rule = new Rule();
		$rule->controlaction_id = $request->input('controlaction_id');
		$rule->column = $request->input('column');
		
		$rule->save();

		$variables = $request->input('rules_variables');

		for($i = 0; $i < sizeof($variables); $i++){
			
			$rule_variable = new RulesVariables();
			$rule_variable->rule_id = $rule->id;
			$rule_variable->variable_id = $variables[$i]['variable_id'];
			$rule_variable->state_id = $variables[$i]['state_id'];
			$rule_variable->save();
			
		}
		
		
		return response()->json([
	         	'rule_id' => $rule->id
     		]);
		
	}

	public function edit(Request $request){

		$rule_id = $request->input('rule_id');
		Rule::where('id', $rule_id)->update(["column" => $request->input('column')]);

		$variables = $request->input('rules_variables');

		for($i = 0; $i < sizeof($variables); $i++){
			RulesVariables::where('rule_id', $rule_id)->where('variable_id', $variables[$i]['variable_id'])->update(["state_id" => $variables[$i]['state_id']]);
		}
	}

	public function delete(Request $request){
		Rule::where('id', $request->input('rule_id'))->delete();
		RulesVariables::where('rule_id', $request->input('rule_id'))->delete();
	}

	public function deleteAll(Request $request){
		SafetyConstraints::where('controlaction_id', $request->input('controlaction_id'))->delete();

		foreach(Rule::where('controlaction_id', $request->input('controlaction_id')) as $rule){
			RulesVariables::where('rule_id', $rule->id)->delete();
		}

		Rule::where('controlaction_id', $request->input('controlaction_id'))->delete();
	}

}