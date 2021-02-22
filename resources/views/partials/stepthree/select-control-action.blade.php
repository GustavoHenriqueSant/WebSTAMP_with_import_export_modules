<div class="substep__title">
    Select your Control Action
</div>

<div class="substep__content" aligned="center">

    <div class="container">
        Select controller:
        <select id="controller-select" name="controller-select">
            <option disabled selected value> -- Select controller --</option>
        	@foreach(App\Controllers::where('project_id', $project_id)->get() as $controller)
	           <option value="{{$controller->id}}">{{$controller->name}}</option>
            @endforeach
        </select>
        <div id="div_select_control_action" hidden="true">
            <br/><br/>
            Select control action:
            @foreach(App\Controllers::where('project_id', $project_id)->get() as $controller)
            <select id="control-actions-select" class="hide-control-actions-options" name="control-actions-of-controller-{{$controller->id}}">
                <option value = "0" disabled selected value> -- Select control action -- </option>
                @foreach(App\ControlAction::where('controller_id', $controller->id)->get() as $ca)
                    <option value="{{$ca->id}}">{{$ca->name}}</option>
                @endforeach
            </select>     
            @endforeach
        </div>
        <div style="text-align: center; margin-top: 20px; display: none;" id="load-step3-content">
         <button style={position: absolute;} id="load-button">Load</button>
        </div>
    </div>
</div>