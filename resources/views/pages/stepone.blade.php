@extends('layouts.master')

@section('content')
	
	<div class="substep substep--select-control-action" id="addrule">
        @include('partials.stepone.select-control-action')
	</div>
	    
    @foreach(App\Controllers::where('project_id', 1)->get() as $controller)
    	@foreach(App\ControlAction::where('controller_id', $controller->id)->get() as $ca)
		    <div id="control-action-{{$ca->id}}" class="hide-control-actions" name="control-action-{{$ca->id}}" style="display:none;">
			    <div class="substep substep--addrule" id="addrule">
			        @include('partials.stepone.addrules')
			    </div>
			    <div class="substep substep--rule" id="rule-control-action-{{$ca->id}}">
			        @include('partials.stepone.rules')
			    </div>
			    <div class="substep substep--context-table" id="context-table">
			        @include('partials.stepone.context-table')
			    </div>
			    <div class="substep substep--safety-constraints" id="safety-constraints">
			        @include('partials.stepone.safety-constraints')
			    </div>
			    @include('partials.stepone.add-uca', ['controller' => $controller, 'controlaction' => $ca])
			    @include('partials.stepone.suggested-uca', ['controller' => $controller, 'controlaction' => $ca])
			</div>
		@endforeach
    @endforeach

@endsection

<!--
@section('dialogs')
	@foreach(App\ControlAction::all() as $ca)
		 @include('partials.stepone.add-unsafecontrolaction', ['controlaction_id' => $ca->id])
	@endforeach
@endsection
-->