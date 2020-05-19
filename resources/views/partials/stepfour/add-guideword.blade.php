<?php $add = 'guideword-' . $uca_id; ?>

@extends('partials.drop')

@section('content-add')
    <label for="guideword-name" class="add-drop__label">
        Guideword name
    </label>
    <select id="guideword-{{$uca_id}}">
    	<option disabled style="background: black; color: white;" style="background: black; color: white;">External ↔ Controller</option>
    		<option>Control input or external information wrong or missing</option>
    	<option disabled style="background: black; color: white;">Controller</option>
    		<option>Inadequate Control Algorithm</option>
    		<option>Process Model inconsistent, incorrect or incomplete</option>
    	<option disabled style="background: black; color: white;">Controller ↔ Actuator</option>
    		<option>Inappropriate, ineffective or missing control action</option>
    	<option disabled style="background: black; color: white;">Actuator</option>
    		<option>Inadequate Operation</option>
    	<option disabled style="background: black; color: white;">Actuator ↔ Controlled Process</option>
    		<option>Delayed Operation</option>
    	<option disabled style="background: black; color: white;">Controller 2 ↔ Controlled Process</option>
    		<option>Conflicting Control Actions</option>
    	<option disabled style="background: black; color: white;">Controlled Process</option>
    		<option>Component Failures</option>
    		<option>Changes over time</option>
    	<option disabled style="background: black; color: white;">External ↔ Controlled Process</option>
    		<option>Process Input missing or wrong</option>
    		<option>Unidentified or out-of-range disturbance</option>
    	<option disabled style="background: black; color: white;">Controlled Process ↔ External</option>
    		<option>Process output contributes to hazard</option>
    	<option disabled style="background: black; color: white;">Controlled Process ↔ Sensor</option>
    		<option>Feedback delays</option>
    		<option>Measurement inaccuracies</option>
    		<option>Incorrect or no information provided</option>
    	<option disabled style="background: black; color: white;">Sensor</option>
    		<option>Inadequate Operation</option>
    	<option disabled style="background: black; color: white;">Sensor ↔ Controller</option>
    		<option>Feedback Delays</option>
    		<option>Inadequate or missing feedback</option>
    </select>
@overwrite
