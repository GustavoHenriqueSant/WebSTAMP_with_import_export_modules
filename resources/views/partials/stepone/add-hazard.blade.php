<?php $add = 'hazard'; ?>

@extends('partials.drop')

@section('content-add')
    <label for="hazard-name" class="add-drop__label">
        System-level Hazard
    </label>
    <textarea id="hazard-name" name="hazard-name" maxlength="500" rows="1" cols="50" name="hazard-name" type="text" class="add-drop__textarea responsive_textarea"  placeholder="Type here (max: 500 characters)"  style="resize: none;" required></textarea>
    <label for="hazard-loss-association" class="add-drop__label">
        Losses Associated
    </label>
    <select multiple id="hazard-loss-association" name="hazard-loss-association[]" class="add-drop__select add-drop__input" required>
    </select>
@overwrite
