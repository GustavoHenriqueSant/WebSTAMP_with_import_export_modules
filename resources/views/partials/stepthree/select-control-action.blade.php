<div class="substep__title">
    Select your Control Action
</div>

<div class="substep__content" aligned="center">

    <div class="container">

        <select id="control-actions-select" name="control-actions-select">
        	@foreach(App\Controllers::where('project_id', $project_id)->get() as $controller)
                @foreach(App\ControlAction::where('controller_id', $controller->id)->get() as $ca)
	                <option value="{{$ca->id}}">{{$ca->name}} ({{$ca->controller->name}})</option>
	            @endforeach
            @endforeach
        </select>     

    </div>

</div>