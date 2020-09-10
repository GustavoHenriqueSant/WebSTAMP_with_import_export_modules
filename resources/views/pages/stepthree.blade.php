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

				<div class="substep substep--add-uca" id="add-uca-control-action-{{$ca->id}}">
					@include('partials.stepthree.add-uca', ['controller' => $controller, 'controlaction' => $ca])
				</div>

				<div class="substep substep--safety-constraints" id="safety-constraints">
					@include('partials.stepthree.safety-constraints')
				</div>

				<!-- commented blade code -->
				{{-- @include('partials.stepthree.suggested-uca', ['controller' => $controller, 'controlaction' => $ca]) ---}} 
				@include('partials.stepthree.edit-uca', ['controller' => $controller, 'controlaction' => $ca])


			</div>
		@endforeach
	@endforeach

@endsection

