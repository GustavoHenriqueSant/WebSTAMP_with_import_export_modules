<div class="substep__title">
    Connections
</div>

<div class="substep__add" data-component="add-button" data-add="connections_content-{{$component_id}}">
    +
</div>

<div class="substep__content connections-content" id="connections_content-{{$component_id}}">
    <ul class="substep__list">
        @foreach (App\Connections::where('controller_id', $component_id)->get() as $connection)
            <li class="item" id="connection-{{$connection->id}}">
                <div class="item__title">
                    {{ $connection->name }} 
                </div>
                <div class="item__actions">
                    <div class="item__title">
                        <img src="{{ asset('images/edit.ico') }}" alt="Edit" width="20" class="navbar__logo">
                    </div>
                    <form action="/deleteconnections" method="POST" class="delete-form ajaxform" data-delete="connection">
                        <div class="item__title">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <input id="project_id" name="project_id" type="hidden" value="1">
                            <input id="connection_id" name="connection_id" type="hidden" value="{{$connection->id}}">
                            <input type="image" src="{{ asset('images/delete.ico') }}" alt="Delete" width="20" class="navbar__logo">
                        </div>
                    </form>
                </div>
            </li>
        @endforeach
    </ul>
</div>