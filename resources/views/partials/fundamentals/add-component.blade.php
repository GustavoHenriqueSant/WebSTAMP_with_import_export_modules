<?php $add = 'component'; ?>

@extends('partials.drop')

@section('content-add')
    <label for="component-name" class="add-drop__label">
        Component name
    </label>
    <input id="component-name" name="component-name" type="text" class="add-drop__input" required>
    <label for="component-type" class="add-drop__label">
        Component type
    </label>
    <select id="component-type" name="component-type" class="add-drop__select add-drop__input" required>
        <option value="Actuator">Actuator</option>
        @if (App\ControlledProcess::where('project_id', $project_id)->count() > 0)
            <option value="ControlledProcess" disabled>Controlled Process</option>
        @else
            <option value="ControlledProcess">Controlled Process</option>
        @endif
        <option value="Controller">Controller</option>
        <option value="Sensor">Sensor</option>
    </select>
@overwrite
