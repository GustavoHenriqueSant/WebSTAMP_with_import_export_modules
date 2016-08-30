<?php $add = 'controlaction'; ?>

@extends('partials.drop')

@section('content-add')
    <label for="controlaction-name" class="add-drop__label">
        Control Action Name
    </label>
    <input id="controlaction-name" type="text" class="add-drop__input">
    <label for="controller-association" class="add-drop__label">
        Controller Associated
    </label>
    <select id="controller-association" class="add-drop__select add-drop__input">
        @foreach (App\Components::all() as $component)
        	@if($component->type === 'Controller')
        		<option value="{{$component->id}}">{{$component->name}}</option>
        	@endif
        @endforeach
    </select>
@overwrite
