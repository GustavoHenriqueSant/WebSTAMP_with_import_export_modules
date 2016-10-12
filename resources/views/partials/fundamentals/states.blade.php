<div class="substep__title">
    States
</div>

<div class="substep__add" data-component="add-button" data-add="state">
    +
</div>

<div class="substep__content" id="variables_content" data-variables="{{$variables}}">
    <ul class="substep__list">
        @foreach (App\State::all() as $state)
            <li class="item">
                <div class="item__title">
                    {{ $state->name }}
                </div>
                <div class="item__actions__action">
                    <span>×</span> {{ $state->variable->name }}
                </div>
                <div class="item__actions">
                    <div class="item__title">
                        <img src="{{ asset('images/edit.ico') }}" alt="Edit" width="20" class="navbar__logo">
                    </div>
                    <div class="item__title">
                        <img src="{{ asset('images/delete.ico') }}" alt="Delete" width="20" class="navbar__logo">
                    </div>
                </div>
            </li>
        @endforeach
    </ul>
</div>
