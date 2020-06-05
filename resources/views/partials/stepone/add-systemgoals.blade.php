<?php $add = 'systemgoal'; ?>

@extends('partials.drop')

@section('content-add')
    <label for="systemgoal-name" class="add-drop__label">
        System Goal name
    </label>
    <input id="systemgoal-name" name="systemgoals-name" type="text" class="add-drop__input" required>
@overwrite
