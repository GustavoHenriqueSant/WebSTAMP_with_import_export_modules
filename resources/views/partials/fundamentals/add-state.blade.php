<?php $add = 'state-variable-' . $variable_id; ?>

@extends('partials.drop')

@section('content-add')
    <label for="state-name-{{$variable_id}}" class="add-drop__label">
        State name
    </label>
    <input id="state-name-{{$variable_id}}" name="state-name-{{$variable_id}}" type="text" class="add-drop__input">
    <input type="hidden" name="variable_id" id="variable_id" value="{{$variable_id}}">
@overwrite
