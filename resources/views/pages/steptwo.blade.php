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
<a id="inline" href="#data">This shows content of element who has id="data"</a>

<div style="display:none"><div id="data">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</div></div>
@endsection

@section('dialogs')
	@include('partials.steptwo.add-guideword')
@endsection