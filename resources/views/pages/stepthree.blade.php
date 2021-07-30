@extends('layouts.master')

@section('content')

	<div class="substep substep--select-control-action">
		@include('partials.stepthree.select-control-action')
	</div>

	<?php
		$isValidParameters = isset($_GET["ca"]) && is_numeric($_GET["ca"]) && isset($_GET["controller"]) && is_numeric($_GET["controller"]);

		if ($isValidParameters) {
			$ca_id = $_GET["ca"];
			$controller_id = $_GET["controller"];

			$controller = App\Controllers::where('id', $controller_id)->first();
			$ca = App\ControlAction::where('id', $ca_id)->first();
		} else {
			$controller = 0;
			$ca = null;
		}
	?>

	<!-- Avoid error when the first controller does not have any control actions -->
	@if($ca !== null)
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
	@endif

@endsection

