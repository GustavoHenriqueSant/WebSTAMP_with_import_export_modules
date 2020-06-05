<?php $add = 'loss'; ?>

@extends('partials.drop')

@section('content-add')
    <label for="loss-name" class="add-drop__label">
    	Losses
    </label>
    <input id="loss-name" name="loss-name" type="text" class="add-drop__input" required>
@overwrite
