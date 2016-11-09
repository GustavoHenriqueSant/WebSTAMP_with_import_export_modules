@extends('layouts.master')

<?php $fundamentals = ['systemgoals', 'accidents', 'hazards', 'systemsafetyconstraint', 'components']; ?>

@section('content')
    @foreach ($fundamentals as $f)
        <div class="substep substep--{{ $f }}" id="{{ $f }}">
          @include('partials.fundamentals.' . $f)
        </div>
    @endforeach
@endsection

<?php $addItens = ['systemgoals', 'accident', 'hazard', 'component', 'systemsafetyconstraint', 'variable']; ?>

@section('dialogs')
    @foreach ($addItens as $addItem)
        @include('partials.fundamentals.add-' . $addItem)
    @endforeach
    @foreach(App\Controllers::where('project_id', $project_id)->get() as $controller)
    	@include('partials.fundamentals.add-variable', ['component_id' => $controller->id])
    @endforeach
    @foreach(App\Controllers::where('project_id', $project_id)->get() as $controller)
        @include('partials.fundamentals.add-controlactions', ['controller_id' => $controller->id])
    @endforeach
@endsection