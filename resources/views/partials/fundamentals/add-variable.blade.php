<?php $add = 'variable'; ?>

@extends('partials.drop')

@section('content-add')
    <label for="variable-name" class="add-drop__label">
        Variable name
    </label>
    <input id="variable-name" name="variable-name" type="text" class="add-drop__input">
@overwrite
