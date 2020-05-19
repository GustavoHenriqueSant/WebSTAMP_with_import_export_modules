<?php
	$add = 'controlactions_content-'.$controller_id;
?>

@extends('partials.drop')

@section('content-add')
    <label for="controlaction-name" class="add-drop__label">
        Control Action Name
    </label>
    <input id="controlaction-{{$controller_id}}-name" name="controlaction-name" type="text" class="add-drop__input">
@overwrite
