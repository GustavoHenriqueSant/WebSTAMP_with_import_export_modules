<?php $add = 'component'; ?>

@extends('partials.drop')

@section('content-add')
    <label for="component-name" class="add-drop__label">
        Component name
    </label>
    <input id="component-name" type="text" class="add-drop__input">
    <label for="component-type" class="add-drop__label">
        Component type
    </label>
    <select id="component-type" class="add-drop__select add-drop__input">
        <option value="A">Actuator</option>
        <option value="B">Controlled Process</option>
        <option value="C">Controller</option>
        <option value="D">Sensor</option>
    </select>
@overwrite
