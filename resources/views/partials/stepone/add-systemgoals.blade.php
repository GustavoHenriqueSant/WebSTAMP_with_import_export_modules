<?php $add = 'systemgoal'; ?>

@extends('partials.drop')

@section('content-add')
	<label for="systemgoal-name" class="add-drop__label">
		System Goal
	</label>
	<textarea id="systemgoal-name" maxlength="500" rows="1" cols = "50" name="systemgoals-name" type="text" class="add-drop__textarea responsive_textarea"  placeholder="Type here (max: 500 characters)"  style="resize: none;" required></textarea>
@overwrite
