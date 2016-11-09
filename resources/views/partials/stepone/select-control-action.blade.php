<div class="substep__title">
    Select your Control Action
</div>

<div class="substep__content" aligned="center">

    <div class="container">

        <select id="control-actions-select" name="control-actions-select">
            @foreach(App\ControlAction::all() as $ca)
                <option value="{{$ca->id}}">{{$ca->name}} ({{$ca->controller->name}})</option>
            @endforeach
        </select>     

    </div>

</div>