<?php $add = 'accident'; ?>

@extends('partials.drop')

@section('content-add')
    <label for="accident-name" class="add-drop__label">
        @if($project_type == "Safety")
            Accidents
        @else
            Losses
        @endif
    </label>
    <input id="accident-name" name="accident-name" type="text" class="add-drop__input" required>
@overwrite
