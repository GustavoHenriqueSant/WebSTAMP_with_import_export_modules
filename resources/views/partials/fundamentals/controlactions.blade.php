<div class="substep__title">
    Control Actions
</div>

<div class="substep__add" data-component="add-button" data-add="controlaction">
    +
</div>

<div class="substep__content" id="controlactions_content" data-components="{{$components}}">
    <ul class="substep__list">
        @foreach (App\ControlAction::all() as $controlAction)
            <li class="item" id="controlaction-{{$controlAction->id}}">
                <div class="item__title">
                    {{ $controlAction->name }}
                </div>
                <div class="item__actions__action">
                    {{ $controlAction->component->name }}
                </div>
                <div class="item__actions">
                    <div class="item__title">
                        <img src="{{ asset('images/edit.ico') }}" alt="Edit" width="20" class="navbar__logo">
                    </div>
                    <form action="/deletecontrolaction" method="POST" class="delete-form ajaxform" data-delete="controlaction">
                        <div class="item__title">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <input id="project_id" name="project_id" type="hidden" value="1">
                            <input id="controlaction_id" name="controlaction_id" type="hidden" value="{{$controlAction->id}}">
                            <input type="image" src="{{ asset('images/delete.ico') }}" alt="Delete" width="20" class="navbar__logo">
                        </div>
                    </form>
                </div>
            </li>
        @endforeach
    </ul>
</div>