<?php $add = 'hazard'; ?>

@extends('partials.drop')

@section('content-add')
    <label for="hazard-name" class="add-drop__label">
        System-level Hazard name
    </label>
    <input id="hazard-name" name="hazard-name" type="text" class="add-drop__input" required>
    <label for="hazard-loss-association" class="add-drop__label">
        Losses Associated
    </label>
    <select multiple id="hazard-loss-association" name="hazard-loss-association[]" class="add-drop__select add-drop__input" required>
        @foreach ($losses as $loss)
        	
        @endforeach
    </select>
@overwrite
