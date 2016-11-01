@extends('layouts.master')

@section('content')
	
	<div class="substep substep--select-control-action" id="addrule">
        @include('partials.stepone.select-control-action')
	</div>
	    
    @foreach(App\ControlAction::all() as $ca)
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

		</div>
    @endforeach

@endsection