<div id="testezika" style="display: none;">
		<div class="vex-dialog-form">
			<form action="/addcausal" class="add-causal" method="POST">
				<input type="hidden" name="_token" value="{{csrf_token()}}">
				<input type="hidden" name="uca" id="uca" value="0">
				<div class="container">
		    		<div class="container-fluid" style="margin-top: 10px">
		    			<div class="table-row header">
		    				<div class="text">Scenario</div>
		    				<div class="text">Associated Causal Factors</div>
		    				<div class="text">Requirements</div>
		    				<div class="text">Role</div>
		    				<div class="text">Rationale</div>
		    				<div class="text">Include?</div>
		    			</div>

		    			<div id="guidewords">
		        			@foreach(App\CausalAnalysis::where('safety_constraint_id', 0)->get() as $causal)
			        			<div class="table-row center" id="guideword-{{$causal->id}}">
			        				<div class="text">{{$causal->scenario}}</div>
			        				<div class="text">{{$causal->associated_causal_factor}}</div>
			        				<div class="text">{{$causal->requirement}}</div>
			        				<div class="text">{{$causal->role}}</div>
			        				<div class="text">{{$causal->rationale}}</div>
			        				<div class="text"><input type="checkbox" style="display: inline-block; height: 100%; vertical-align: middle;" class="associated-checkbox" id="checkbox-{{$causal->id}}"></div>
			        			</div>
		        			@endforeach
		        		</div>
		    		</div>
		    	</div>
		    	<div class="vex-dialog-input"></div>
		    	<div class="vex-dialog-buttons">
		        	<button class="vex-dialog-button-primary vex-dialog-button vex-first"> Import </button>
		        	<div style="display: table; margin: 0 auto;">
		        		<button class="vex-dialog-button-primary vex-dialog-button vex-first"> Add </button>
		        		<button class="vex-dialog-button-secondary vex-dialog-button vex-last"> Cancel </button>
		        	</div>
		        </div>
	        </form>
		</div>
	</div>