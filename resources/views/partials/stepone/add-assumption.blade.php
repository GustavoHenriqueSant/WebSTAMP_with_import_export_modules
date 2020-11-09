<?php $add = 'assumption'; ?>

@extends('partials.drop')

@section('content-add')
	<label for="assumption-name" class="add-drop__label">
		Assumption
	</label>
	<textarea id="assumption-name" maxlength="500" rows="1" cols = "50" name="assumption-name" type="text" class="add-drop__textarea responsive_textarea"  placeholder="Type here (max: 500 characters)"  style="resize: none;" required></textarea>
@overwrite>