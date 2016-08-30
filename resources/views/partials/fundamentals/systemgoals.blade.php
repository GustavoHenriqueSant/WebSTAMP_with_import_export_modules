<div class="substep__title">
    System Goals
</div>

<div class="substep__add" data-component="add-button" data-add="systemgoal">
    +
</div>

<div class="substep__content">
    <ul class="substep__list">
        @foreach (App\SystemGoals::all() as $systemGoal)
            <li class="item">
                <div class="item__title">
                    G-{{$systemGoal->id}}: {{$systemGoal->name}}
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
