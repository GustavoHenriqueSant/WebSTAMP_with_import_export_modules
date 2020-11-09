<?php $add = 'systemsafetyconstraint'; ?>

@extends('partials.drop')

@section('content-add')
    <label for="systemsafetyconstraint-name" class="add-drop__label">
        System-level Safety Contraint
    </label>
    <textarea id="systemsafetyconstraint-name" name="systemsafetyconstraint-name" maxlength="500" rows="1" cols="50" name="assumption-name" type="text" class="add-drop__textarea responsive_textarea"  placeholder="Type here (max: 500 characters)"  style="resize: none;" required></textarea>
    <label for="ssc-hazard-association" class="add-drop__label">
        Hazards Associated
    </label>
    <select multiple id="ssc-hazard-association" name="ssc-hazard-association[]" class="add-drop__select add-drop__input" required>
    </select>
@overwrite