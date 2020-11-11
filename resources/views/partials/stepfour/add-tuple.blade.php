<div id="add-tuple" style="display: none;">
        <!-- <div class="center">
                <b>Unsafe Control Action</b>: <span name="4tupleUCA" id="4tupleUCA"></span>
        </div>
        <div class="center">
                <b>Guide Question</b>: <span name="4tupleGQ" id="4tupleGQ"></span>
        </div> -->
        <!-- @begin Showing the Generic Control Loop -->
        <div class="center">
                <button class="gcl2" name="gcl2">Show Generic Control Loop</button>
        </div>

        <br/>
        
        <div class="gcl center" name="gcl" style="display: none;">
                <img src="{{ asset('images/GCL.png') }}" alt="Generic Control Loop" class="image" syle="visible: false;">
        </div>
        <!-- @end Showing the Generic Control Loop -->
	<form action="/addtuple" class="adding-tuple" method="POST">
		<input type="hidden" name="_token" value="{{csrf_token()}}">
		<div class="vex-dialog-form">
			<div class="container">
        		<div class="container-fluid">
        			<div class="table-row" id="guidewords">
	        			<div class="text center">
	        				<select id="guideword" class="guideword-combo-tuple" style="background-color: #f0f0f0;">
	        					<option disabled selected value="0">[Guideword]</option>
						    	@foreach(App\Guidewords::all() as $guideword)
						    		<option value="{{$guideword->id}}" title="{{$guideword->guideword}}">{{$guideword->guideword}}</option>
						    	@endforeach
						    </select>
	        				<textarea class="step2_textarea__modal" name="scenario" id="scenario" placeholder="Add the scenario here"></textarea>
	        			</div>
                        <div class="text center"><br/>
                        	<textarea class="step2_textarea__modal" name="associated" id="associated" placeholder="Add the associated causal factor here"></textarea>
                        </div>
                        <div class="text center"><br/>
                        	<textarea class="step2_textarea__modal" name="requirement" id="requirement" placeholder="Add the recommendation here"></textarea>
                        </div>
<!--                         <div class="text center"><br/>
                        	<textarea class="step2_textarea__modal" name="role" id="role" placeholder="Add the role here"></textarea>
                        </div> -->
                        <div class="text center"><br/>
                        	<textarea class="step2_textarea__modal" name="rationale" id="rationale" placeholder="Add the rationale here"></textarea>
                        </div>
	        		</div>
	        		<input type="hidden" name="uca" id="uca" value="0">
        		</div>
        	</div>
        	<div class="vex-dialog-input"></div>
        	<div class="vex-dialog-buttons">
	        	<div style="display: table; margin: 0 auto;">
	        		<button class="vex-dialog-button-primary vex-dialog-button vex-first">Add</button>
	        		<!--<button class="vex-dialog-button-secondary vex-dialog-button vex-last">Cancel</button>-->
	        	</div>
	        </div>
		</div>
	</form>
</div>