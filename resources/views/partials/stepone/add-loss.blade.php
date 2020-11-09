<?php $add = 'loss'; ?>

@extends('partials.drop')

@section('content-add')
	<label for="loss-name" class="add-drop__label">
		Loss
	</label>
	<textarea id="loss-name" maxlength="500" rows="1" cols = "50"  name="loss-name" type="text" class="add-drop__textarea responsive_textarea"  placeholder="Type here (max: 500 characters)"  style="resize: none;" required></textarea>
@overwrite
