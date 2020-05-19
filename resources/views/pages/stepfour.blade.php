@extends('layouts.master')

@section('content')
	
	<div class="substep substep--select-control-action-two" id="sca">
        @include('partials.stepone.select-control-action')
	</div>
	
	@foreach(App\Controllers::where('project_id', $project_id)->get() as $controller)
    	@foreach(App\ControlAction::where('controller_id', $controller->id)->get() as $ca)
		    <div class="substep substep--showtable-{{$ca->id}} hide-control-actions" id="showtable-{{$ca->id}}" style="display: none;">
		    	@include('partials.steptwo.steptwotable')
		    </div>
		    @foreach(App\SafetyConstraints::where('controlaction_id', $ca->id)->get() as $uca)
		    	@include('partials.steptwo.associated-causal-factors', ['uca_id' => $uca->id, 'uca_context' => $uca->context])
		    	@include('partials.steptwo.information-lifecycle', ['uca_id' => $uca->id, 'uca_context' => $uca->context])
		    @endforeach
	    @endforeach
    @endforeach

@endsection

@section('dialogs')
	@include('partials.steptwo.add-tuple')
@endsection