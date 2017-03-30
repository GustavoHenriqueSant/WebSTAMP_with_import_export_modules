@extends('layouts.master')

@section('content')
	
	<div class="substep substep--select-control-action-two" id="sca">
        @include('partials.stepone.select-control-action')
	</div>
	    
    @foreach(App\ControlAction::all() as $ca)
	    <div class="substep substep--showtable-{{$ca->id}}" id="showtable-{{$ca->id}}">
	    	@include('partials.steptwo.steptwotable')
	    </div>
    @endforeach
    
    @include('partials.steptwo.associated-causal-factors')

@endsection

@section('dialogs')
	@foreach(App\SafetyConstraints::all() as $sc)
		@include('partials.steptwo.add-guideword', ['uca_id' => $sc->id])
		@include('partials.steptwo.add-tuple')
	@endforeach

@endsection