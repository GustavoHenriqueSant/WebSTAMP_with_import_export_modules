<div class="substep__title">
    Components
</div>

<div class="substep__add" data-add="component">
    +
</div>

<div class="substep__content">
   
   <div id="controllers">
        @foreach (App\Controllers::where('project_id', $project_id)->get() as $component)
            <button class="accordion" id="controller-{{$component->id}}"><b>[Controller]</b> {{$component->name}}</button>
            <div class="panel" id="panel-controller-{{$component->id}}">

                <ul class="substep__list" id="add-controller">
                            <li class="item" id="controller-{{$component->id}}">
                                <div class="item__title">
                                    <input type="text" class="item__input" id="controller-description-{{ $component->id }}" value="{{ $component->name }}" disabled>
                                </div>
                                <div class="item__actions">
                                    <form action ="/editcontroller" method="POST" class="edit-form ajaxform" data-edit="controller">
                                    <div class="item__title">
                                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                                        <input id="project_id" name="project_id" type="hidden" value="1">
                                        <input id="controller_id" name="controller_id" type="hidden" value="{{$component->id}}">
                                        <input type="image" src="{{ asset('images/edit.ico') }}" alt="Edit" width="20" class="navbar__logo">
                                    </div>
                                </form>
                                    <form action ="/deletecomponent" method="POST" class="delete-form ajaxform" data-delete="component">
                                        <div class="item__title">
                                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                                            <input id="project_id" name="project_id" type="hidden" value="1">
                                            <input id="component_id" name="component_id" type="hidden" value="{{$component->id}}">
                                            <input id="component_type" name="component_type" type="hidden" value="controller">
                                            <input type="image" src="{{ asset('images/trash.png') }}" alt="Delete" width="20" class="navbar__logo">
                                        </div>
                                    </form>
                                </div>
                            </li>
                </ul>

                <div class="substep substep--connections" id="connection-controller-{{$component->id}}">
                    @include('partials.steptwo.connections', ['component_id' => $component->id, 'name' => $component->name, 'type' => 'controller'])
                </div>

                <div class="substep substep--controlactions" id="controlaction-{{$component->id}}">
                    @include('partials.steptwo.controlactions', ['component_id'=> $component->id])
                </div>

                <div class="substep substep--variables-associated" id="variables-{{$component->id}}">
                    @include('partials.steptwo.variables', ['component_id'=> $component->id, 'component_name' => $component->name])
                </div>

            </div>
        @endforeach
    </div>

    <div id="actuators">
        @foreach (App\Actuators::where('project_id', $project_id)->get() as $component)
            <button class="accordion" id="actuator-{{$component->id}}"><b>[Actuator]</b> {{$component->name}}</button>
            <div class="panel" id="panel-actuator-{{$component->id}}">
                <ul class="substep__list" id="add-actuator">
                    @foreach (App\Actuators::where('project_id', $project_id)->where('id', $component->id)->get() as $component)
                            <li class="item" id="actuator-{{$component->id}}">
                                <div class="item__title">
                                    <input type="text" class="item__input" id="actuator-description-{{ $component->id }}" value="{{ $component->name }}" disabled>
                                </div>
                                <div class="item__actions">
                                    <form action ="/editactuator" method="POST" class="edit-form ajaxform" data-edit="actuator">
                                    <div class="item__title">
                                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                                        <input id="project_id" name="project_id" type="hidden" value="1">
                                        <input id="actuator_id" name="actuator_id" type="hidden" value="{{$component->id}}">
                                        <input type="image" src="{{ asset('images/edit.ico') }}" alt="Edit" width="20" class="navbar__logo">
                                    </div>
                                </form>
                                    <form action ="/deletecomponent" method="POST" class="delete-form ajaxform" data-delete="component">
                                        <div class="item__title">
                                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                                            <input id="project_id" name="project_id" type="hidden" value="1">
                                            <input id="component_id" name="component_id" type="hidden" value="{{$component->id}}">
                                            <input id="component_type" name="component_type" type="hidden" value="actuator">
                                            <input type="image" src="{{ asset('images/trash.png') }}" alt="Delete" width="20" class="navbar__logo">
                                        </div>
                                    </form>
                                </div>
                            </li>
                    @endforeach
                </ul>
                <div class="substep substep--connections" id="connection-actuator-{{$component->id}}">
                    @include('partials.steptwo.connections', ['component_id' => $component->id, 'name' => $component->name, 'type' => 'actuator'])
                </div>
            </div>
        @endforeach
    </div>

    <div id="controlledprocess">
        @foreach (App\ControlledProcess::where('project_id', $project_id)->get() as $component)
            <button class="accordion" id="controlledprocess-{{$component->id}}"><b>[Controlled Process]</b> {{$component->name}}</button>
            <div class="panel" id="panel-controlledprocess-{{$component->id}}">
                <ul class="substep__list" id="add-controlledprocess">
                    @foreach (App\ControlledProcess::where('project_id', $project_id)->where('id', $component->id)->get() as $component)
                        <li class="item" id="controlledprocess-{{$component->id}}">
                            <div class="item__title">
                                <input type="text" class="item__input" id="controlledprocess-description-{{ $component->id }}" value="{{ $component->name }}" disabled>
                            </div>
                            <div class="item__actions">
                                <form action ="/editcontrolledprocess" method="POST" class="edit-form ajaxform" data-edit="controlledprocess">
                                    <div class="item__title">
                                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                                        <input id="project_id" name="project_id" type="hidden" value="1">
                                        <input id="controlledprocess_id" name="controlledprocess_id" type="hidden" value="{{$component->id}}">
                                        <input type="image" src="{{ asset('images/edit.ico') }}" alt="Edit" width="20" class="navbar__logo">
                                    </div>
                                </form>
                                <form action ="/deletecomponent" method="POST" class="delete-form ajaxform" data-delete="component">
                                    <div class="item__title">
                                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                                        <input id="project_id" name="project_id" type="hidden" value="1">
                                        <input id="component_id" name="component_id" type="hidden" value="{{$component->id}}">
                                        <input id="component_type" name="component_type" type="hidden" value="controlledprocess">
                                        <input type="image" src="{{ asset('images/trash.png') }}" alt="Delete" width="20" class="navbar__logo">
                                    </div>
                                </form>
                            </div>
                        </li>
                    @endforeach
                </ul>
                <div class="substep substep--connections" id="connection-controlled_process-{{$component->id}}">
                    @include('partials.steptwo.connections', ['component_id' => $component->id, 'name' => $component->name, 'type' => 'controlled_process'])
                </div>
                
                <div class="substep substep--variables-associated" id="variables-0">
                    @include('partials.steptwo.variables')
                </div>
            </div>
        @endforeach
    </div>

    <div id="sensors">
        @foreach (App\Sensors::where('project_id', $project_id)->get() as $component)
            <button class="accordion" id="sensor-{{$component->id}}"><b>[Sensor]</b> {{$component->name}}</button>
            <div class="panel" id="panel-sensor-{{$component->id}}">
                <ul class="substep__list" id="add-sensor">
                    @foreach (App\Sensors::where('project_id', $project_id)->where('id', $component->id)->get() as $component)
                        <li class="item" id="actuator-{{$component->id}}">
                            <div class="item__title">
                                <input type="text" class="item__input" id="sensor-description-{{ $component->id }}" value="{{ $component->name }}" disabled>
                            </div>
                            <div class="item__actions">
                                <form action ="/editsensor" method="POST" class="edit-form ajaxform" data-edit="sensor">
                                    <div class="item__title">
                                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                                        <input id="project_id" name="project_id" type="hidden" value="1">
                                        <input id="sensor_id" name="sensor_id" type="hidden" value="{{$component->id}}">
                                        <input type="image" src="{{ asset('images/edit.ico') }}" alt="Edit" width="20" class="navbar__logo">
                                    </div>
                                </form>
                                <form action ="/deletecomponent" method="POST" class="delete-form ajaxform" data-delete="component">
                                    <div class="item__title">
                                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                                        <input id="project_id" name="project_id" type="hidden" value="1">
                                        <input id="component_id" name="component_id" type="hidden" value="{{$component->id}}">
                                        <input id="component_type" name="component_type" type="hidden" value="sensor">
                                        <input type="image" src="{{ asset('images/trash.png') }}" alt="Delete" width="20" class="navbar__logo">
                                    </div>
                                </form>
                            </div>
                        </li>
                    @endforeach
                </ul>
                <div class="substep substep--connections" id="connection-sensor-{{$component->id}}">
                    @include('partials.steptwo.connections', ['component_id' => $component->id, 'name' => $component->name, 'type' => 'sensor'])
                </div>               
            </div>
        @endforeach
    </div>
</div>
