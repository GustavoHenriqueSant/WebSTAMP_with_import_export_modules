@extends('layouts.master')

@section('content')
	
	<div class="substep substep--select-control-action">
        @include('partials.stepthree.select-control-action')
	</div>
	
	@foreach(App\Controllers::where('project_id', $project_id)->get() as $controller)
		@foreach(App\ControlAction::where('controller_id', $controller->id)->get() as $ca)
		    	<div id="control-action-{{$ca->id}}" class="hide-control-actions" name="control-action-{{$ca->id}}" hidden="true" style="display:none;" >
		    		
			    <div class="substep substep--addrule" id="addrule">
			        @include('partials.stepthree.addrules')
			    </div>
			   
			    <div class="substep substep--rule" id="rule-control-action-{{$ca->id}}">
			        @include('partials.stepthree.rules')
			    </div>
			    
			    <div class="substep substep--context-table" id="context-table">
			        @include('partials.stepthree.context-table')
			    </div>
			    <div class="substep substep--safety-constraints" id="safety-constraints">
			        @include('partials.stepthree.safety-constraints')
			    </div>
			    @include('partials.stepthree.add-uca', ['controller' => $controller, 'controlaction' => $ca])
			    @include('partials.stepthree.suggested-uca', ['controller' => $controller, 'controlaction' => $ca])
			</div>
		@endforeach
	@endforeach
		
@endsection

<!--
@section('dialogs')
	@foreach(App\ControlAction::all() as $ca)
		 @include('partials.stepthree.add-unsafecontrolaction', ['controlaction_id' => $ca->id])
	@endforeach
@endsection
-->