<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\ContextTable;

use App\State;

use App\ControlAction as CA;

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

    public function delete(Request $request) {
        ContextTable::where('controlaction_id', $request->input('controlaction_id'))->delete();
    }

    public function generateUCA(Request $request){
        $controlaction_id = $request->get("controlaction_id");  
        $provided = [];
        $not_provided = [];
        $wrong_time = [];
        $early = [];
        $late = [];
        $soon = [];
        $long = [];

        foreach(ContextTable::where('controlaction_id', $controlaction_id)->get() as $row){
            if($row->ca_not_provided == "true")
                array_push($not_provided, $row->context);

            if($row->ca_provided == "true")
                array_push($provided, $row->context);

            if($row->wrong_time_order == "true")
                array_push($wrong_time, $row->context);

            if($row->ca_too_early == "true")
                array_push($early, $row->context);

            if($row->ca_too_late == "true")
                array_push($late, $row->context);

            if($row->ca_too_soon == "true")
                array_push($soon, $row->context);

            if($row->ca_too_long == "true")
                array_push($long, $row->context);
        }

        $ucas = [];
        array_push($ucas, $this->createUCA($not_provided, "not provided", $controlaction_id));
        array_push($ucas, $this->createUCA($provided, "provided", $controlaction_id));
        array_push($ucas, $this->createUCA($wrong_time, "provided in wrong time or order", $controlaction_id));
        array_push($ucas, $this->createUCA($early, "provided too early", $controlaction_id));
        array_push($ucas, $this->createUCA($late, "provided too late", $controlaction_id));
        array_push($ucas, $this->createUCA($soon, "stopped too soon", $controlaction_id));
        array_push($ucas, $this->createUCA($long, "applied too long", $controlaction_id));
        $ucas = array_filter($ucas);
        foreach ($ucas as $value) {
            echo $value . "<br/>";
        }

        
    }


    public function createUCA($array, $type, $controlaction_id) {
        $array_aux = [];

        foreach ($array as $value) {
            $aux = explode(",", $value);
            foreach($aux as $r) {
                array_push($array_aux, trim($r));
            }
        }

        $aux = array_count_values($array_aux);
        arsort($aux);
        $controller = "";
        $controlaction = "";

        foreach(CA::where("id", $controlaction_id)->get() as $ca){
            $controller = $ca->controller->name;
            $controlaction = $ca->name;
        }

        $uca = ucfirst(strtolower($controller)) . " <b>". $type ."</b> " . strtolower($controlaction) . " <b>when</b> ";

        $context = [];
        foreach ($aux as $key => $value) {
            if ($value == max($aux)) {
                foreach(State::where('id', $key)->get() as $state){
                    array_push($context, strtolower($state->variable->name) . " is " . strtolower($state->name));
                }
            }
        }

        foreach($context as $key => $c) {
            if ($key == 0){
                $uca .= $c;
            } else {
                $uca .= " and ".$c;
            }
        }
        if (!empty($context))
            return $uca;
        else
            return null;
    }


}
