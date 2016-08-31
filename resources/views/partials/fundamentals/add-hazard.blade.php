<?php $add = 'hazard'; ?>

@extends('partials.drop')

@section('content-add')
    <label for="hazard-name" class="add-drop__label">
        Hazard name
    </label>
    <input id="hazard-name" name="hazard-name" type="text" class="add-drop__input">
    <label for="hazard-accident-association" class="add-drop__label">
        Accident Associated
    </label>
    <select multiple id="hazard-accident-association" name="hazard-accident-association[]" class="add-drop__select add-drop__input">
        @foreach (App\Accidents::all() as $accident)
        	<option value="{{$accident->id}}">[A-{{$accident->id}}] {{$accident->name}}</option>
        @endforeach
    </select>
@overwrite
