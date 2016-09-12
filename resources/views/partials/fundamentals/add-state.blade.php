<?php $add = 'state'; ?>

@extends('partials.drop')

@section('content-add')
    <label for="state-name" class="add-drop__label">
        State name
    </label>
    <input id="state-name" name="state-name" type="text" class="add-drop__input">
    <label for="variable-association" class="add-drop__label">
        Variable Associated
    </label>
    <select id="variable-association" name="variable-association" class="add-drop__select add-drop__input">
        @foreach ($variables as $variable)
        	<option value="{{$variable->id}}">{{$variable->name}}</option>
        @endforeach
    </select>
@overwrite
