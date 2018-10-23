<div id="information-{{$uca_id}}" style="display: none;">

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
			<b>Unsafe Control Action</b>: {{$sc->unsafe_control_action}}
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

	<div class="center">
		<h3>Suggestion of tuples related to Information Lifecycle</h3>
	</div>	

	<br/>
	<?php $causal_already_added = []; ?>
	@foreach(App\CausalAnalysis::where('safety_constraint_id', $uca_id)->get() as $causal)
		<?php
			if ($causal->guideword_id == 13 || $causal->guideword_id == 14) {
				array_push($causal_already_added, 15);
			} else if ($causal->guideword_id == 18) {
				array_push($causal_already_added, 17);
			} else {
				array_push($causal_already_added, $causal->guideword_id);
			}
		?>
	@endforeach
	
	<div class="vex-dialog-form">
		<form action="/addinformation" class="add-causal" method="POST">
			<div class="container">
	    		<div class="container-fluid" style="margin-top: 10px">
	    			<div class="table-row header">
	    				<div class="text">Scenario</div>
	    				<div class="text">Associated Causal Factors</div>
	    				<div class="text">Recommendations</div>
	    				<input type="hidden" id="uca" name="uca" value="{{$uca->id}}"/>
	    				<!-- <div class="text">Role</div> -->
	    				<div class="text">Rationale</div>
	    				<div class="text">Include?</div>
	    			</div>

	    			<div id="table-right-{{$uca_id}}" class="hidding-guidewords showtable-right">
	        			@foreach(App\CausalAnalysis::where('safety_constraint_id', 0)->where('role', 'N/A')->get() as $causal)
	        				<?php
	        					if(in_array($causal->guideword_id, $causal_already_added)) {
	        						$hide = false;
	        					} else {
	        						$hide = true;
	        					}
	        				?>
	        				@if ($hide == false)
		        				<div class="table-row" id="guidewords-{{$causal->id}}">
		        			@else
		        				<div class="table-row guideword-{{$causal->guideword_id}}" id="guidewords-{{$causal->id}}" style="display: none;">
		        			@endif
		        				<div class="text" id="guideword-scenario-{{$causal->id}}">
		        					<span id="getting-scenario-{{$causal->id}}">
		        						{{$causal->scenario}}
		        					</span>
		        				</div>
		        				<div class="text" id="guideword-associated-{{$causal->id}}">
		        					{{$causal->associated_causal_factor}}
		        				</div>
		        				<div class="text" id="guideword-requirement-{{$causal->id}}">
		        					{{$causal->requirement}}
		        				</div>
		        				<div class="text" id="guideword-rationale-{{$causal->id}}">
		        					{{$causal->rationale}}
		        				</div>
		        				<div class="text center"><input type="checkbox" style="display: inline-block; height: 100%; vertical-align: middle;" class="associated-checkbox" id="checkbox-{{$causal->id}}"></div>
		        				<input type="hidden" name="guideword-{{$causal->id}}" id="guideword-{{$causal->id}}" value="{{$causal->guideword_id}}">
		        			</div>
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