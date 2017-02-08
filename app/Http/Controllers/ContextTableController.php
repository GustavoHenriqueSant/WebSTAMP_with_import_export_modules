<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\ContextTable;

class ContextTableController extends Controller
{
    public function save(Request $request){
    	
    	$context_table = new ContextTable();

    	$context_table->context = $request->input("states");
    	$context_table->controlaction_id = $request->input("controlaction_id");
    	$context_table->ca_provided = $request->input("provided");
    	$context_table->ca_not_provided = $request->input("not_provided");
    	$context_table->wrong_time_order = $request->input("wrong_time");
    	$context_table->ca_too_early = $request->input("early");
    	$context_table->ca_too_late = $request->input("late");
    	$context_table->ca_too_soon = $request->input("soon");
    	$context_table->ca_too_long = $request->input("long");
    	$context_table->save();

    	return response()->json([
        	'states' => $context_table->context,
        	'controlaction_id' => $context_table->controlaction_id,
        	'ca_provided' => $context_table->ca_provided,
        	'ca_not_provided' => $context_table->ca_not_provided,
        	'wrong_time_order' => $context_table->wrong_time_order,
        	'ca_too_early' => $context_table->ca_too_early,
        	'ca_too_late' => $context_table->ca_too_late,
        	'ca_too_soon' => $context_table->ca_too_soon,
        	'ca_too_long' => $context_table->ca_too_long
    	]);
    }
}
