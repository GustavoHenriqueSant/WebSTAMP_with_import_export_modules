<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Rules;

use Illuminate\Routing\Redirector;

use Illuminate\Http\RedirectResponse;

class RuleController extends Controller
{
    
	public function add(Request $request){
		/*
		$existsVariable = true;
		$i = 0;
		$rule_index = Rules::where('controlaction_id', $request->get('controlaction_id'))->max('index') + 1;
		do {
			$i++;
			$rule = new Rules();
			$rule->index = $rule_index;
			$rule->state_id = $request->get('variable_id_'.$i);
			$rule->controlaction_id = $request->get('controlaction_id');
			// $rule->project_id = 1;

			$rule->save();
			if ($request->get('variable_id_'.($i+1)) == null)
				$existsVariable = false;
		}while($existsVariable);

		return redirect(route('stepone'));
		*/

		$rule = new Rules();
		$rule->index = $request->input('rule_index');
		$rule->variable_id = $request->input('variable_id');
		$rule->state_id = $request->input('state_id');
		$rule->controlaction_id = $request->input('controlaction_id');
		$rule->save();

		//return redirect()->route('stepone', ['controlaction_id', $rule->controlaction_id]);

		return redirect(route('stepone'));

		/*return response()->json([
         	'id' => $rule->id,
         	'rule_index' => $rule->index,
         	'state_id' => $rule->state_id,
         	'controlaction_id' => $rule->controlaction_id,
         	'variable_id' => $rule->variable_id
     	]);*/
	}

	public function delete(Request $request){
		Rules::where('index', $request->input('rule_index'))->where('controlaction_id', $request->input('controlaction_id'))->delete();
	}

}