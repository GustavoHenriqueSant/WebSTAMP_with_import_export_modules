<?php
	$unsafe = App\SafetyConstraints::where('id', $uca_id)->get()[0];
	$controller = $unsafe->controlaction->controller->name;

	$controller_2 = App\Connections::where('output_component_id', $unsafe->controlaction->controller->id)->where('type_output', 'controller')->where('type_input', 'controller')->get();
	$controller_2 = $controller_2[0]->input_component_id;
	if (count($controller_2))
		$controller_2 = false;
	else
		$controller_2 = App\Controllers::find($controller_2);

	$actuator = App\Connections::where('output_component_id', $unsafe->controlaction->controller->id)->where('type_input', 'actuator')->get();
	$actuator = $actuator[0]->input_component_id;
	$actuator = App\Actuators::find($actuator);

	$controlled_process = App\Connections::where('type_input', 'controlled_process')->get();
	$controlled_process = $controlled_process[0]->input_component_id;
	$controlled_process = App\ControlledProcess::find($controlled_process);

	$sensor = App\Connections::where('output_component_id', $controlled_process->id)->where('type_input', 'sensor')->get();
	$sensor = $sensor[0]->input_component_id;
	$sensor = App\Sensors::find($sensor);

	$variable = "";
	$context = [];
	$contexts = explode(",", $uca_context);

	foreach($contexts as $state_id){
		foreach(App\State::where('id', $state_id)->get() as $c){
			array_push($context, $c->variable->name);
		}
	}
	
	foreach ($context as $key => $value) {
		if ($key == 0)
			$variable .= $value;
		else if ($key == count($context)-1)
			$variable .= " and " . $value;
		else
			$variable .= ", " . $value;
	}
?>

<div id="approach-{{$uca_id}}" style="display: none;">
		<div class="vex-dialog-form">
			<form action="/addcausal" class="add-causal" method="POST">
				<input type="hidden" name="_token" value="{{csrf_token()}}">
				<input type="hidden" name="uca" id="uca" value="0">

				<div class="center">
					<select id="show-guidewords-{{$uca_id}}" class="choose-guideword">
						<option value="left">Left side: Safe control action provided but not followed or executed</option>
						<option value="right">Right side: Unsafe control action provided or safe control action required but not provided</option>
					</select>
				</div>

				<div class="container">
		    		<div class="container-fluid" style="margin-top: 10px">
		    			<div class="table-row header">
		    				<div class="text">Scenario</div>
		    				<div class="text">Associated Causal Factors</div>
		    				<div class="text">Recommendations</div>
		    				<!-- <div class="text">Role</div> -->
		    				<div class="text">Rationale</div>
		    				<div class="text">Include?</div>
		    			</div>

		    			<div id="table-left-{{$uca_id}}" class="hidding-guidewords showtable-left" style="display: none;">
		        			@foreach(App\CausalAnalysis::where('safety_constraint_id', 0)->where('scenario', 'not like', '%[ACTUATOR]%')->where('guideword_id', '>', 3)->where('guideword_id', '<', 13)->get() as $causal)
			        			@if($controller_2 != false || $causal->guideword_id != 7)
			        			<div class="table-row" id="guidewords-{{$causal->id}}">
			        				<div class="text" id="guideword-scenario-{{$causal->id}}">
			        					<?php
			        						$causal->scenario = str_replace("[CONTROLLER]", $controller, $causal->scenario);
			        						$causal->scenario = str_replace("[CONTROLLER2]", $controller_2, $causal->scenario);
			        						$causal->scenario = str_replace("[ACTUATOR]", $actuator->name, $causal->scenario);
			        						$causal->scenario = str_replace("[CONTROLLED PROCESS]", $controlled_process->name, $causal->scenario);
			        						$causal->scenario = str_replace("[SENSOR]", $sensor->name, $causal->scenario);
			        						$causal->scenario = str_replace("[VARIABLE]", $variable, $causal->scenario);
			        					?>
			        					<span class="listing-guideword">
		        							[<b style="font-size: 16px; text-align: center;">{{$causal->guideword->guideword}}</b>] <br/>
			        					</span>
			        					<span id="getting-scenario-{{$causal->id}}">
			        						{{$causal->scenario}}
			        					</span>
			        				</div>
			        				<div class="text" id="guideword-associated-{{$causal->id}}">
			        					<?php
			        						$causal->associated_causal_factor = str_replace("[CONTROLLER]", $controller, $causal->associated_causal_factor);
			        						$causal->associated_causal_factor = str_replace("[ACTUATOR]", $actuator->name, $causal->associated_causal_factor);
			        						$causal->associated_causal_factor = str_replace("[CONTROLLED PROCESS]", $controlled_process->name, $causal->associated_causal_factor);
			        						$causal->associated_causal_factor = str_replace("[SENSOR]", $sensor->name, $causal->associated_causal_factor);
			        						$causal->associated_causal_factor = str_replace("[VARIABLE]", $variable, $causal->associated_causal_factor);
			        					?>
			        					{{$causal->associated_causal_factor}}
			        				</div>
			        				<div class="text" id="guideword-requirement-{{$causal->id}}">
			        					<?php
			        						$causal->requirement = str_replace("[CONTROLLER]", $controller, $causal->requirement);
			        						$causal->requirement = str_replace("[ACTUATOR]", $actuator->name, $causal->requirement);
			        						$causal->requirement = str_replace("[CONTROLLED PROCESS]", $controlled_process->name, $causal->requirement);
			        						$causal->requirement = str_replace("[SENSOR]", $sensor->name, $causal->requirement);
			        						$causal->requirement = str_replace("[VARIABLE]", $variable, $causal->requirement);
			        					?>
			        					{{$causal->requirement}}
			        				</div>
			        				<div class="text" id="guideword-rationale-{{$causal->id}}">
			        					<?php
			        						$causal->rationale = str_replace("[CONTROLLER]", $controller, $causal->rationale);
			        						$causal->rationale = str_replace("[ACTUATOR]", $actuator->name, $causal->rationale);
			        						$causal->rationale = str_replace("[CONTROLLED PROCESS]", $controlled_process->name, $causal->rationale);
			        						$causal->rationale = str_replace("[SENSOR]", $sensor->name, $causal->rationale);
			        						$causal->rationale = str_replace("[VARIABLE]", $variable, $causal->rationale);
			        					?>
			        					{{$causal->rationale}}
			        				</div>
			        				<div class="text center"><input type="checkbox" style="display: inline-block; height: 100%; vertical-align: middle;" class="associated-checkbox" id="checkbox-{{$causal->id}}"></div>
			        				<input type="hidden" name="guideword-{{$causal->id}}" id="guideword-{{$causal->id}}" value="{{$causal->guideword_id}}">
			        			</div>
			        			@endif
		        			@endforeach
		        		</div>


		        		<div id="table-right-{{$uca_id}}" class="hidding-guidewords showtable-right" style="display: none;">
		        			@foreach(App\CausalAnalysis::where('safety_constraint_id', 0)->whereNotBetween('guideword_id', [4,12])->get() as $causal)
			        			@if($controller_2 != false || $causal->guideword_id != 7)
			        			<div class="table-row" id="guidewords-{{$causal->id}}">
			        				<div class="text" id="guideword-scenario-{{$causal->id}}">
			        					<?php
			        						$causal->scenario = str_replace("[CONTROLLER]", $controller, $causal->scenario);
			        						$causal->scenario = str_replace("[CONTROLLER2]", $controller_2, $causal->scenario);
			        						$causal->scenario = str_replace("[ACTUATOR]", $actuator->name, $causal->scenario);
			        						$causal->scenario = str_replace("[CONTROLLED PROCESS]", $controlled_process->name, $causal->scenario);
			        						$causal->scenario = str_replace("[SENSOR]", $sensor->name, $causal->scenario);
			        						$causal->scenario = str_replace("[VARIABLE]", $variable, $causal->scenario);
			        					?>
			        					<span class="listing-guideword">
			        						[<b style="font-size: 16px; text-align: center;">{{$causal->guideword->guideword}}</b>] <br/>
			        					</span>
			        					<span id="getting-scenario-{{$causal->id}}">
			        						{{$causal->scenario}}
			        					</span>
			        				</div>
			        				<div class="text" id="guideword-associated-{{$causal->id}}">
			        					<?php
			        						$causal->associated_causal_factor = str_replace("[CONTROLLER]", $controller, $causal->associated_causal_factor);
			        						$causal->associated_causal_factor = str_replace("[ACTUATOR]", $actuator->name, $causal->associated_causal_factor);
			        						$causal->associated_causal_factor = str_replace("[CONTROLLED PROCESS]", $controlled_process->name, $causal->associated_causal_factor);
			        						$causal->associated_causal_factor = str_replace("[SENSOR]", $sensor->name, $causal->associated_causal_factor);
			        						$causal->associated_causal_factor = str_replace("[VARIABLE]", $variable, $causal->associated_causal_factor);
			        					?>
			        					{{$causal->associated_causal_factor}}
			        				</div>
			        				<div class="text" id="guideword-requirement-{{$causal->id}}">
			        					<?php
			        						$causal->requirement = str_replace("[CONTROLLER]", $controller, $causal->requirement);
			        						$causal->requirement = str_replace("[ACTUATOR]", $actuator->name, $causal->requirement);
			        						$causal->requirement = str_replace("[CONTROLLED PROCESS]", $controlled_process->name, $causal->requirement);
			        						$causal->requirement = str_replace("[SENSOR]", $sensor->name, $causal->requirement);
			        						$causal->requirement = str_replace("[VARIABLE]", $variable, $causal->requirement);
			        					?>
			        					{{$causal->requirement}}
			        				</div>
			        				<div class="text" id="guideword-rationale-{{$causal->id}}">
			        					<?php
			        						$causal->rationale = str_replace("[CONTROLLER]", $controller, $causal->rationale);
			        						$causal->rationale = str_replace("[ACTUATOR]", $actuator->name, $causal->rationale);
			        						$causal->rationale = str_replace("[CONTROLLED PROCESS]", $controlled_process->name, $causal->rationale);
			        						$causal->rationale = str_replace("[SENSOR]", $sensor->name, $causal->rationale);
			        						$causal->rationale = str_replace("[VARIABLE]", $variable, $causal->rationale);
			        					?>
			        					{{$causal->rationale}}
			        				</div>
			        				<div class="text center"><input type="checkbox" style="display: inline-block; height: 100%; vertical-align: middle;" class="associated-checkbox" id="checkbox-{{$causal->id}}"></div>
			        				<input type="hidden" name="guideword-{{$causal->id}}" id="guideword-{{$causal->id}}" value="{{$causal->guideword_id}}">
			        			</div>
			        			@endif
		        			@endforeach
		        		</div>
		    		</div>
		    	</div>
		    	<div class="vex-dialog-input"></div>
		    	<div class="vex-dialog-buttons">
		        	<!--<button class="vex-dialog-button-primary vex-dialog-button vex-first"> Import </button>-->
		        	<div style="display: table; margin: 0 auto;">
		        		<button class="vex-dialog-button-primary vex-dialog-button vex-first"> Add </button>
		        	</div>
		        </div>
	        </form>
		</div>
	</div>