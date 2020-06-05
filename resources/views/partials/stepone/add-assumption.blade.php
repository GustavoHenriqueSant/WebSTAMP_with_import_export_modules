<?php $add = 'assumption'; ?>

@extends('partials.drop')

@section('content-add')
    <label for="assumption-name" class="add-drop__label">
        Assumption text
    </label>
    <textarea id="assumption-name" rows="5" cols = "50" name="assumption-name" type="text" class="add-drop__textarea" placeholder="Type here"  style="resize: none;" required></textarea>
@overwrite>