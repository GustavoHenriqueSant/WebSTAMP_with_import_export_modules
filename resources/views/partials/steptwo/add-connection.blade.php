<?php $add = 'connections-'.$type.'-'.$id; ?>

@extends('partials.drop')

@section('content-add')
    <label for="component-type" class="add-drop__label">
        Connected to:
    </label>
    <select id="connections-{{$type}}-{{$id}}" name="connections-{{$type}}-{{$id}}" class="add-drop__select add-drop__input" required>
    	@foreach (App\Controllers::where('project_id', $project_id)->get() as $controller)
        	<option value="controller-{{$controller->id}}">{{$controller->name}}</option>
        @endforeach
        @foreach (App\Actuators::where('project_id', $project_id)->get() as $actuator)
        	<option value="actuator-{{$actuator->id}}">{{$actuator->name}}</option>
        @endforeach
        @foreach (App\ControlledProcess::where('project_id', $project_id)->get() as $controlledprocess)
        	<option value="controlled_process-{{$controlledprocess->id}}">{{$controlledprocess->name}}</option>
        @endforeach
        @foreach (App\Sensors::where('project_id', $project_id)->get() as $sensors)
        	<option value="sensor-{{$sensors->id}}">{{$sensors->name}}</option>
        @endforeach
    </select>
    <input type="hidden" value="{{$name}}" name="component_name" id="component_name">
@overwrite