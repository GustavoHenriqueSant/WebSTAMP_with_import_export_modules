<?php $add = 'uca-' . $controlaction_id; ?>

@extends('partials.drop')

@section('content-add')
    <label for="uca-name" class="add-drop__label">
        Unsafe Control Action
    </label>
    <input id="uca-name-{{$controlaction_id}}" name="uca-name-{{$controlaction_id}}" type="text" class="add-drop__input" required>

    <label for="type-uca" class="add-drop__label">
        Type
    </label>
    <select id="type-uca-{{$controlaction_id}}" name="type-uca-{{$controlaction_id}}" class="add-drop__select add-drop__input" required>
        	<option value="Provided">[Provided]</option>
            <option value="Not Provided">[Not Provided]</option>
            <option value="Wrong Time">[Wrong time]</option>
            <option value="Wrong order">[Wrong order]</option>
            <option value="Provided too early">[Provided too early]</option>
            <option value="Provided too late">[Provided too late]</option>
            <option value="Stopped too soon">[Stopped too soon]</option>
            <option value="Applied too long">[Applied too long]</option>
    </select>

    <label for="sc-name-{{$controlaction_id}}" class="add-drop__label">
        Safety Constraint Associated 
    </label>
    <input id="sc-name-{{$controlaction_id}}" name="uca-name-{{$controlaction_id}}" type="text" class="add-drop__input" required>
@overwrite