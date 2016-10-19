<?php $add = 'variable'; ?>

@extends('partials.drop')

@section('content-add')
    <label for="variable-name" class="add-drop__label">
        Variable name
    </label>
    <input id="variable-name" name="variable-name" type="text" class="add-drop__input" required>

    <label for="state-name-1" class="add-drop__label">
        State name [1]
    </label>
    <input id="state-name-1" name="state-name-1" type="text" class="add-drop__input" required>

    <label for="state-name-2" class="add-drop__label">
        State name [2]
    </label>
    <input id="state-name-2" name="state-name-2" type="text" class="add-drop__input" required>
    
@overwrite
