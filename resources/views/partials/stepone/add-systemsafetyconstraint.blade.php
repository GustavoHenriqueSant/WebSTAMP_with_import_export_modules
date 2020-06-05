<?php $add = 'systemsafetyconstraint'; ?>

@extends('partials.drop')

@section('content-add')
    <label for="systemsafetyconstraint-name" class="add-drop__label">
        System-level Safety Contraint name
    </label>
    <input id="systemsafetyconstraint-name" name="systemsafetyconstraint-name" type="text" class="add-drop__input" required>
@overwrite