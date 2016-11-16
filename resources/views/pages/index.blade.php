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
    <!-- Including all basic fundamentals -->
    @foreach ($addItens as $addItem)
        @include('partials.fundamentals.add-' . $addItem)
    @endforeach

    <!-- Including variables for each Controllers and for the Controlled Process -->
    @foreach(App\Controllers::where('project_id', $project_id)->get() as $controller)
    	@include('partials.fundamentals.add-variable', ['component_id' => $controller->id])
    @endforeach

    <!-- Including Control Actions for each Controller -->
    @foreach(App\Controllers::where('project_id', $project_id)->get() as $controller)
        @include('partials.fundamentals.add-controlactions', ['controller_id' => $controller->id])
    @endforeach

    <!-- Including Connection for each Component -->
    @foreach(App\Controllers::where('project_id', $project_id)->get() as $controller)
        @include('partials.fundamentals.add-connection', ['type' => 'controller', 'id' => $controller->id, 'name' => $controller->name])
    @endforeach
    @foreach(App\Actuators::where('project_id', $project_id)->get() as $actuator)
        @include('partials.fundamentals.add-connection', ['type' => 'actuator', 'id' => $actuator->id, 'name' => $actuator->name])
    @endforeach
    @foreach(App\ControlledProcess::where('project_id', $project_id)->get() as $controlledprocess)
        @include('partials.fundamentals.add-connection', ['type' => 'controlled_process', 'id' => $controlledprocess->id, 'name' => $controlledprocess->name])
    @endforeach
    @foreach(App\Sensors::where('project_id', $project_id)->get() as $sensor)
        @include('partials.fundamentals.add-connection', ['type' => 'sensor', 'id' => $sensor->id, 'name' => $sensor->name])
    @endforeach
@endsection