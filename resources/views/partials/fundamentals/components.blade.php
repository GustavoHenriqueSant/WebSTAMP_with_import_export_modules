<div class="substep__title">
    Components
</div>

<div class="substep__add" data-component="add-button" data-add="component">
    +
</div>

<div class="substep__content">
   
   <div id="controllers">
        @foreach ($components as $component)
            @if ($component->type == "Controller")
            <button class="accordion"><b>[Controller]</b> {{$component->name}}</button>
            <div class="panel">
                
                <div class="substep substep--controlactions" id="controlaction-{{$component->id}}">
                    @include('partials.fundamentals.controlactions', ['component_id'=> $component->id])
                </div>

                <div class="substep substep--variables-associated" id="variables-{{$component->id}}">
                    @include('partials.fundamentals.variables', ['component_id'=> $component->id, 'component_name' => $component->name])
                </div>

            </div>
            @endif
        @endforeach
    </div>

    <div id="actuators">
        @foreach ($components as $component)
            @if($component->type == "Actuator")
                <button class="accordion"><b>[Actuator]</b> {{$component->name}}</button>
                <div class="panel">
                    <ul class="substep__list" id="add-actuator">
                        @foreach ($components as $component)
                            @if ($component->type == "Actuator")
                                <li class="item" id="actuator-{{$component->id}}">
                                    <div class="item__title">
                                        {{ $component->name }}
                                    </div>
                                    <div class="item__actions">
                                        <div class="item__title">
                                            <img src="{{ asset('images/edit.ico') }}" alt="Edit" width="20" class="navbar__logo">
                                        </div>
                                        <form action ="/deletecomponent" method="POST" class="delete-form ajaxform" data-delete="component">
                                            <div class="item__title">
                                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                                <input id="project_id" name="project_id" type="hidden" value="1">
                                                <input id="component_id" name="component_id" type="hidden" value="{{$component->id}}">
                                                <input id="component_type" name="component_type" type="hidden" value="{{$component->type}}">
                                                <input type="image" src="{{ asset('images/delete.ico') }}" alt="Delete" width="20" class="navbar__logo">
                                            </div>
                                        </form>
                                    </div>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </div>
            @endif
        @endforeach
    </div>

    <div id="controlledprocess">
        @foreach ($components as $component)
            @if($component->type == "ControlledProcess")
                <button class="accordion"><b>[Controlled Process]</b> {{$component->name}}</button>
                <div class="panel">
                    <ul class="substep__list" id="add-controlledprocess">
                        @foreach ($components as $component)
                        @if ($component->type == "ControlledProcess")
                            <li class="item" id="actuator-{{$component->id}}">
                                <div class="item__title">
                                    {{ $component->name }}
                                </div>
                                <div class="item__actions">
                                    <div class="item__title">
                                        <img src="{{ asset('images/edit.ico') }}" alt="Edit" width="20" class="navbar__logo">
                                    </div>
                                    <form action ="/deletecomponent" method="POST" class="delete-form ajaxform" data-delete="component">
                                        <div class="item__title">
                                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                                            <input id="project_id" name="project_id" type="hidden" value="1">
                                            <input id="component_id" name="component_id" type="hidden" value="{{$component->id}}">
                                            <input id="component_type" name="component_type" type="hidden" value="{{$component->type}}">
                                            <input type="image" src="{{ asset('images/delete.ico') }}" alt="Delete" width="20" class="navbar__logo">
                                        </div>
                                    </form>
                                </div>
                            </li>
                            @endif
                        @endforeach
                    </ul>
                </div>
            @endif
        @endforeach
    </div>

    <div id="sensors">
        @foreach ($components as $component)
            @if($component->type == "Sensor")
                <button class="accordion"><b>[Sensor]</b> {{$component->name}}</button>
                <div class="panel">
                    <ul class="substep__list" id="add-sensor">
                        @foreach ($components as $component)
                        @if ($component->type == "Sensor")
                            <li class="item" id="actuator-{{$component->id}}">
                                <div class="item__title">
                                    {{ $component->name }}
                                </div>
                                <div class="item__actions">
                                    <div class="item__title">
                                        <img src="{{ asset('images/edit.ico') }}" alt="Edit" width="20" class="navbar__logo">
                                    </div>
                                    <form action ="/deletecomponent" method="POST" class="delete-form ajaxform" data-delete="component">
                                        <div class="item__title">
                                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                                            <input id="project_id" name="project_id" type="hidden" value="1">
                                            <input id="component_id" name="component_id" type="hidden" value="{{$component->id}}">
                                            <input id="component_type" name="component_type" type="hidden" value="{{$component->type}}">
                                            <input type="image" src="{{ asset('images/delete.ico') }}" alt="Delete" width="20" class="navbar__logo">
                                        </div>
                                    </form>
                                </div>
                            </li>
                            @endif
                        @endforeach
                    </ul>
                </div>
            @endif
        @endforeach
    </div>
</div>
