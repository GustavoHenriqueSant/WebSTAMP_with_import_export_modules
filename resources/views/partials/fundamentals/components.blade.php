<div class="substep__title">
    Components
</div>

<div class="substep__add" data-component="add-button" data-add="component">
    +
</div>

<div class="substep__content">

    <div class="container">

        <div class="table-row-without-border">
            <div class="text">
                <div class="table-row-without-border substep__title">
                    Actuator
                </div>
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

            <div class="text">
                <div class="table-row-without-border  substep__title">
                    Controlled Process
                </div>
                <ul class="substep__list" id="add-controlledprocess">
                    @foreach ($components as $component)
                    @if ($component->type == "ControlledProcess")
                        <li class="item" id="controlledprocess-{{$component->id}}">
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
        </div>

    </div>
    
    <div class="container">

        <div class="table-row-without-border">
            <div class="text">
                <div class="table-row-without-border  substep__title">
                    Controller
                </div>
                <ul class="substep__list" id="add-controller">
                    @foreach ($components as $component)
                    @if ($component->type == "Controller")
                        <li class="item" id="controller-{{$component->id}}">
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

            <div class="text">
                <div class="table-row-without-border  substep__title">
                    Sensor
                </div>
                <ul class="substep__list" id="add-sensor">
                    @foreach ($components as $component)
                    @if ($component->type == "Sensor")
                        <li class="item" id="sensor-{{$component->id}}">
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
        </div>
    </div>
</div>
