<?php $add = 'hazard'; ?>

@extends('partials.drop')

@section('content-add')
    <label for="hazard-name" class="add-drop__label">
        Hazard name
    </label>
    <input id="hazard-name" name="hazard-name" type="text" class="add-drop__input" required>
    <label for="hazard-accident-association" class="add-drop__label">
        @if($project_type == "Safety")
            Accidents Associated
        @else
            Losses Associated
        @endif
    </label>
    <select multiple id="hazard-accident-association" name="hazard-accident-association[]" class="add-drop__select add-drop__input" required>
        @foreach ($accidents as $accident)
        	
        @endforeach
    </select>
@overwrite
