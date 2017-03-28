<div class="substep__title">
    Connections
</div>

<div class="substep__add" data-component="add-button" data-add="connections-{{$type}}-{{$component_id}}">
    +
</div>

<div class="substep__content connections-content" id="connections-{{$type}}-{{$component_id}}">
    <ul class="substep__list">
        @foreach (App\Connections::where('output_component_id', $component_id)->where('type_output', $type)->get() as $connection)
            <li class="item" id="connection-{{$connection->id}}">
                <div class="item__title">
                    @if ($connection->type_input == 'actuator')
                        @foreach (App\Actuators::where('id', $connection->input_component_id)->get() as $actuator)
                            {{$name}} → {{$actuator->name}}
                        @endforeach
                    @elseif ($connection->type_input == 'controlled_process')
                        @foreach (App\ControlledProcess::where('id', $connection->input_component_id)->get() as $controlledprocess)
                            {{$name}} → {{$controlledprocess->name}}
                        @endforeach
                    @elseif ($connection->type_input == 'controller')
                        @foreach (App\Controllers::where('id', $connection->input_component_id)->get() as $controller)
                            {{$name}} → {{$controller->name}}
                        @endforeach
                    @elseif ($connection->type_input == 'sensor')
                        @foreach (App\Sensors::where('id', $connection->input_component_id)->get() as $sensor)
                            {{$name}} → {{$sensor->name}}
                        @endforeach
                    @endif
                </div>
                <div class="item__actions">
                    <form action="/deleteconnections" method="POST" class="delete-form ajaxform" data-delete="connection">
                        <div class="item__title">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <input id="project_id" name="project_id" type="hidden" value="1">
                            <input id="connection_id" name="connection_id" type="hidden" value="{{$connection->id}}">
                            <input type="image" src="{{ asset('images/trash.png') }}" alt="Delete" width="20" class="navbar__logo">
                        </div>
                    </form>
                </div>
            </li>
        @endforeach
        @foreach (App\Connections::where('input_component_id', $component_id)->where('type_input', $type)->get() as $connection)
            <li class="item" class="connection-{{$connection->id}}">
                <div class="item__title">
                    @if ($connection->type_output == 'actuator')
                        @foreach (App\Actuators::where('id', $connection->output_component_id)->get() as $actuator)
                            {{$actuator->name}} → {{$name}}
                        @endforeach
                    @elseif ($connection->type_output == 'controlled_process')
                        @foreach (App\ControlledProcess::where('id', $connection->output_component_id)->get() as $controlledprocess)
                            {{$controlledprocess->name}} → {{$name}}
                        @endforeach
                    @elseif ($connection->type_output == 'controller')
                        @foreach (App\Controllers::where('id', $connection->output_component_id)->get() as $controller)
                            {{$controller->name}} → {{$name}}
                        @endforeach
                    @elseif ($connection->type_output == 'sensor')
                        @foreach (App\Sensors::where('id', $connection->output_component_id)->get() as $sensor)
                            {{$sensor->name}} → {{$name}}
                        @endforeach
                    @endif
                </div>
            </li>
        @endforeach
    </ul>
</div>