<?php
	$unsafe = App\SafetyConstraints::where('id', $uca_id)->get()[0];
	$controller = $unsafe->controlaction->controller->name;

	$controller_2 = App\Connections::where('output_component_id', $unsafe->controlaction->controller->id)->where('type_output', 'controller')->where('type_input', 'controller')->get();
	//$controller_2 = $controller_2[0]->input_component_id;
	if (isset($controller_2))
		$controller_2 = false;
	else
		$controller_2 = App\Controllers::find($controller_2);

	$isActuator = App\Connections::where('output_component_id', $unsafe->controlaction->controller->id)->where('type_input', 'actuator')->count();
	if ($isActuator > 0) {
		$actuator = App\Connections::where('output_component_id', $unsafe->controlaction->controller->id)->where('type_input', 'actuator')->get();
		$actuator = $actuator[0]->input_component_id;
		$actuator = App\Actuators::find($actuator);
	}
	
	$isControlledProcess = App\ControlledProcess::where("project_id", $project_id)->count();
	if ($isControlledProcess > 0) {
		$controlled_process = App\ControlledProcess::where("project_id", $project_id)->get();
		$controlled_process = $controlled_process[0];
	}

	$isSensor = App\Connections::where('output_component_id', $controlled_process->id)->where('type_input', 'sensor')->count();
	if($isSensor){
		$sensor = App\Connections::where('output_component_id', $controlled_process->id)->where('type_input', 'sensor')->get();
		$sensor = $sensor[0]->input_component_id;
	$sensor = App\Sensors::find($sensor);
	} else {
		$sensor = App\Connections::where('output_component_id', $controlled_process->id)->where('type_input', 'controller')->get();
	}

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

	<input type="hidden" name="_token" value="{{csrf_token()}}">
	<input type="hidden" name="uca" id="uca" value="0">

	<div class="center">
		<button class="gcl2" name="gcl2">Show Generic Control Loop</button>
	</div>
	
	<div class="gcl center" name="gcl" style="display: none;">
		<img src="{{ asset('images/GCL.png') }}" alt="Generic Control Loop" class="image" syle="visible: false;">
	</div>

	<br/>

	<div class="center">
		@foreach(App\SafetyConstraints::where('id', $uca->id)->get() as $sc)
			<b>Hazardous Control Action</b>: {{$sc->unsafe_control_action}}
		@endforeach 
	</div>
	<div class="center">
		<?php
		 	$operator = strtolower($ca->controller->name);

            $type = strtolower($sc->type);

            $ca->name = strtolower($ca->name);

            $context = array_pad(explode("when ", $sc->unsafe_control_action, 2), 2, null)[1];
            // Removes the "." in the end of the context
            $context = str_replace(".", "", $context);


            $array_types = explode(";", $type);

            foreach ($array_types as $myType) {
            	if (strpos($sc->unsafe_control_action, $myType) !== false)
            		$type = $myType;
            }

            $guidequestion = "What are the causal factors that make the $ca->name to be $type by the $operator when $context?";
		?>
		<b>Guide Question</b>: What are the causal factors that make the <b>{{$ca->name}}</b> to be <b>{{$type}}</b> by the <b>{{$operator}}</b> when <b>{{$context}}</b>?

	</div>	

	<br/>

	<div class="center">
		<select id="show-guidewords-{{$uca_id}}" class="choose-guideword">
			<option value="right" selected="true">Right side: Hazardous control action provided or safe control action required but not provided</option>
			<option value="left">Left side: Safe control action provided but not followed or executed</option>
		</select>
	</div>

	<br/>
	
		<div class="vex-dialog-form">
			<form action="/addcausal" class="add-causal" method="POST">
				<div class="container">
		    		<div class="container-fluid" style="margin-top: 10px">
		    			<div class="table-row header">
		    				<div class="text">Scenario</div>
		    				<div class="text">Associated causal factor</div>
		    				<div class="text">Recommendation</div>
		    				<input type="hidden" id="uca" name="uca" value="{{$uca->id}}"/>
		    				<!-- <div class="text">Role</div> -->
		    				<div class="text">Rationale</div>
		    				<div class="text">Include?</div>
		    			</div>

		    			<div id="table-right-{{$uca_id}}" class="hidding-guidewords showtable-right">
		        			@foreach(App\CausalAnalysis::where('safety_constraint_id', 0)->whereNotBetween('guideword_id', [4,12])->where('role', '!=', 'N/A')->get() as $causal)
			        			@if($controller_2 != false || $causal->guideword_id != 7)
			        			<div class="table-row" id="guidewords-{{$causal->id}}">
			        				<div class="text" id="guideword-scenario-{{$causal->id}}">
			        					<?php
			        						$causal->scenario = str_replace("[CONTROLLER]", $controller, $causal->scenario);
			        						$causal->scenario = str_replace("[CONTROLLER2]", $controller_2, $causal->scenario);
			        						if ($isActuator > 0)
			        							$causal->scenario = str_replace("[ACTUATOR]", $actuator->name, $causal->scenario);
			        						else
			        							$causal->scenario = str_replace("[ACTUATOR]", $controller, $causal->scenario);
			        						$causal->scenario = str_replace("[CONTROLLED PROCESS]", $controlled_process->name, $causal->scenario);
			        						if ($isSensor > 0)
			        							$causal->scenario = str_replace("[SENSOR]", $sensor->name, $causal->scenario);
			        						else
			        							$causal->scenario = str_replace("[SENSOR]", $controller, $causal->scenario);
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
			        						if ($isActuator > 0)
			        						$causal->associated_causal_factor = str_replace("[ACTUATOR]", $actuator->name, $causal->associated_causal_factor);
			        						else
			        						$causal->associated_causal_factor = str_replace("[ACTUATOR]", $controller, $causal->associated_causal_factor);
			        						$causal->associated_causal_factor = str_replace("[CONTROLLED PROCESS]", $controlled_process->name, $causal->associated_causal_factor);
			        						if ($isSensor > 0)
			        							$causal->associated_causal_factor = str_replace("[SENSOR]", $sensor->name, $causal->associated_causal_factor);
			        						else
			        							$causal->associated_causal_factor = str_replace("[SENSOR]", $controller, $causal->associated_causal_factor);
			        						$causal->associated_causal_factor = str_replace("[VARIABLE]", $variable, $causal->associated_causal_factor);
			        					?>
			        					{{$causal->associated_causal_factor}}
			        				</div>
			        				<div class="text" id="guideword-requirement-{{$causal->id}}">
			        					<?php
			        						$causal->requirement = str_replace("[CONTROLLER]", $controller, $causal->requirement);
			        						if ($isActuator > 0)
			        						$causal->requirement = str_replace("[ACTUATOR]", $actuator->name, $causal->requirement);
			        						else
			        						$causal->requirement = str_replace("[ACTUATOR]", $controller, $causal->requirement);
			        						$causal->requirement = str_replace("[CONTROLLED PROCESS]", $controlled_process->name, $causal->requirement);
			        						if ($isSensor > 0)
			        							$causal->requirement = str_replace("[SENSOR]", $sensor->name, $causal->requirement);
			        						else
			        							$causal->requirement = str_replace("[SENSOR]", $controller, $causal->requirement);
			        						$causal->requirement = str_replace("[VARIABLE]", $variable, $causal->requirement);
			        					?>
			        					{{$causal->requirement}}
			        				</div>
			        				<div class="text" id="guideword-rationale-{{$causal->id}}">
			        					<?php
			        						$causal->rationale = str_replace("[CONTROLLER]", $controller, $causal->rationale);
			        						if ($isActuator > 0)
			        						$causal->rationale = str_replace("[ACTUATOR]", $actuator->name, $causal->rationale);
			        						else
			        						$causal->rationale = str_replace("[ACTUATOR]", $controller, $causal->rationale);
			        						$causal->rationale = str_replace("[CONTROLLED PROCESS]", $controlled_process->name, $causal->rationale);
			        						if ($isSensor > 0)
			        							$causal->rationale = str_replace("[SENSOR]", $sensor->name, $causal->rationale);
			        						else
			        							$causal->rationale = str_replace("[SENSOR]", $controller, $causal->rationale);
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

		        		<div id="table-left-{{$uca_id}}" class="hidding-guidewords showtable-left" style="display: none;">
		        			@foreach(App\CausalAnalysis::where('safety_constraint_id', 0)->where('guideword_id', '>', 3)->where('guideword_id', '<', 13)->where('role', '!=', 'N/A')->get() as $causal)
			        			@if($controller_2 != false || $causal->guideword_id != 7)
			        			<div class="table-row" id="guidewords-{{$causal->id}}">
			        				<div class="text" id="guideword-scenario-{{$causal->id}}">
			        					<?php
			        						$causal->scenario = str_replace("[CONTROLLER]", $controller, $causal->scenario);
			        						$causal->scenario = str_replace("[CONTROLLER2]", $controller_2, $causal->scenario);
			        						if ($isActuator > 0)
			        						$causal->scenario = str_replace("[ACTUATOR]", $actuator->name, $causal->scenario);
			        						else
			        						$causal->scenario = str_replace("[ACTUATOR]", $controller, $causal->scenario);
			        						$causal->scenario = str_replace("[CONTROLLED PROCESS]", $controlled_process->name, $causal->scenario);
			        						if ($isSensor > 0)
			        							$causal->scenario = str_replace("[SENSOR]", $sensor->name, $causal->scenario);
			        						else
			        							$causal->scenario = str_replace("[SENSOR]", $controller, $causal->scenario);
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
			        						if ($isActuator > 0)
			        						$causal->associated_causal_factor = str_replace("[ACTUATOR]", $actuator->name, $causal->associated_causal_factor);
			        						else
			        						$causal->associated_causal_factor = str_replace("[ACTUATOR]", $controller, $causal->associated_causal_factor);
			        						$causal->associated_causal_factor = str_replace("[CONTROLLED PROCESS]", $controlled_process->name, $causal->associated_causal_factor);
			        						if ($isSensor > 0)
			        							$causal->associated_causal_factor = str_replace("[SENSOR]", $sensor->name, $causal->associated_causal_factor);
			        						else
			        							$causal->associated_causal_factor = str_replace("[SENSOR]", $controller, $causal->associated_causal_factor);
			        						$causal->associated_causal_factor = str_replace("[VARIABLE]", $variable, $causal->associated_causal_factor);
			        					?>
			        					{{$causal->associated_causal_factor}}
			        				</div>
			        				<div class="text" id="guideword-requirement-{{$causal->id}}">
			        					<?php
			        						$causal->requirement = str_replace("[CONTROLLER]", $controller, $causal->requirement);
			        						if ($isActuator > 0)
			        						$causal->requirement = str_replace("[ACTUATOR]", $actuator->name, $causal->requirement);
			        						else
			        						$causal->requirement = str_replace("[ACTUATOR]", $controller, $causal->requirement);
			        						$causal->requirement = str_replace("[CONTROLLED PROCESS]", $controlled_process->name, $causal->requirement);
			        						if ($isSensor > 0)
			        							$causal->requirement = str_replace("[SENSOR]", $sensor->name, $causal->requirement);
			        						else
			        							$causal->requirement = str_replace("[SENSOR]", $controller, $causal->requirement);
			        						$causal->requirement = str_replace("[VARIABLE]", $variable, $causal->requirement);
			        					?>
			        					{{$causal->requirement}}
			        				</div>
			        				<div class="text" id="guideword-rationale-{{$causal->id}}">
			        					<?php
			        						$causal->rationale = str_replace("[CONTROLLER]", $controller, $causal->rationale);
			        						if ($isActuator > 0)
			        						$causal->rationale = str_replace("[ACTUATOR]", $actuator->name, $causal->rationale);
			        						else
			        						$causal->rationale = str_replace("[ACTUATOR]", $controller, $causal->rationale);
			        						$causal->rationale = str_replace("[CONTROLLED PROCESS]", $controlled_process->name, $causal->rationale);
			        						if ($isSensor > 0)
			        							$causal->rationale = str_replace("[SENSOR]", $sensor->name, $causal->rationale);
			        						else
			        							$causal->rationale = str_replace("[SENSOR]", $controller, $causal->rationale);
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