@extends('layouts.master')

<?php $steptwo= ($project_type == "Security" ) ? ['components'] : ['components'];
?>

@section('content')
    @foreach ($steptwo as $s)
        <input type="hidden" id="project_id" value="{{$project_id}}">
        <div class="substep substep--{{ $s }}" id="{{ $s }}">
          @include('partials.steptwo.' . $s)
        </div>
    @endforeach
@endsection

@section('dialogs')

    @include('partials.steptwo.add-component')
    @include('partials.steptwo.add-variable')
 
    <!-- Including variables for each Controllers and for the Controlled Process -->
    @foreach(App\Controllers::where('project_id', $project_id)->get() as $controller)
    	@include('partials.steptwo.add-variable', ['component_id' => $controller->id])
    @endforeach

    <!-- Including states for each Variables -->
    @foreach(App\Variable::where('project_id', $project_id)->get() as $variable)
        @include('partials.steptwo.add-state', ['variable_id' => $variable->id])
    @endforeach

    <!-- Including Control Actions for each Controller -->
    @foreach(App\Controllers::where('project_id', $project_id)->get() as $controller)
        @include('partials.steptwo.add-controlactions', ['controller_id' => $controller->id])
    @endforeach

    <!-- Including Connection for each Component -->
    @foreach(App\Controllers::where('project_id', $project_id)->get() as $controller)
        @include('partials.steptwo.add-connection', ['type' => 'controller', 'id' => $controller->id, 'name' => $controller->name])
    @endforeach
    @foreach(App\Actuators::where('project_id', $project_id)->get() as $actuator)
        @include('partials.steptwo.add-connection', ['type' => 'actuator', 'id' => $actuator->id, 'name' => $actuator->name])
    @endforeach
    @foreach(App\ControlledProcess::where('project_id', $project_id)->get() as $controlledprocess)
        @include('partials.steptwo.add-connection', ['type' => 'controlled_process', 'id' => $controlledprocess->id, 'name' => $controlledprocess->name])
    @endforeach
    @foreach(App\Sensors::where('project_id', $project_id)->get() as $sensor)
        @include('partials.steptwo.add-connection', ['type' => 'sensor', 'id' => $sensor->id, 'name' => $sensor->name])
    @endforeach
@endsection