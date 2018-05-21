<div class="substep__title">
    System Goals
</div>

<div class="substep__add" data-component="add-button" data-add="systemgoal">
    +
</div>

<div class="substep__content">
    <ul class="substep__list">
        @foreach (App\SystemGoals::where('project_id', $project_id)->get() as $systemGoal)
            <li class="item" id="systemgoal-{{$systemGoal->id}}">
                <div class="item__title">
                    G-{{$systemGoal->id}}: <input type="text" class="item__input" id="systemgoal-description-{{$systemGoal->id}}" value="{{$systemGoal->name}}" disabled>
                </div>
                <div class="item__actions">
                    <form action ="/editsystemgoal" method="POST" class="edit-form ajaxform" data-edit="systemgoal">
                        <div class="item__title">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <input id="project_id" name="project_id" type="hidden" value="1">
                            <input id="systemgoal_id" name="systemgoal_id" type="hidden" value="{{$systemGoal->id}}">
                            <input type="image" src="{{ asset('images/edit.ico') }}" alt="Edit" width="20" class="navbar__logo">
                        </div>
                    </form>
                    <form action ="/deletesystemgoal" method="POST" class="delete-form ajaxform" data-delete="systemgoal">
                        <div class="item__title">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <input id="project_id" name="project_id" type="hidden" value="1">
                            <input id="systemgoal_id" name="systemgoal_id" type="hidden" value="{{$systemGoal->id}}">
                            <input type="image" src="{{ asset('images/trash.png') }}" alt="Delete" width="20" class="navbar__logo">
                        </div>
                    </form>
                </div>
            </li>
        @endforeach
    </ul>
</div>
