<?php
    if (isset($component_id)){
        $add = 'variable-controller-'.$component_id;
    } else {
        $add = 'variable-0';
        $component_id = 0;
    }
?>


@extends('partials.drop')

@section('content-add')
    <label for="variable-{{$component_id}}-name" class="add-drop__label">
        Variable name
    </label>
    <input id="variable-{{$component_id}}-name" name="variable-{{$component_id}}-name" type="text" class="add-drop__input" required>

    <label for="state-1-{{$component_id}}-name" class="add-drop__label">
        State name [1]
    </label>
    <input id="state-1-{{$component_id}}-name" name="state-1-{{$component_id}}-name" class="states-associated" type="text" class="add-drop__input" required>

    <label for="state-2-{{$component_id}}-name" class="add-drop__label">
        State name [2]
    </label>
    <input id="state-2-{{$component_id}}-name" name="state-2-{{$component_id}}-name" class="states-associated" type="text" class="add-drop__input" required>

    <input type="hidden" id="controller_id" name="controller_id" value="{{$component_id}}"/>
@overwrite
