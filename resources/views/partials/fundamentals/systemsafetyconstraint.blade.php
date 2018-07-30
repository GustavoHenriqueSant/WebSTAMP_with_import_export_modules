<div class="substep__title">
    System Safety Constraints
</div>

<div class="substep__add" data-component="add-button" data-add="systemsafetyconstraint">
    +
</div>

<div class="substep__content">
    <ul class="substep__list">
        @foreach (App\SystemSafetyConstraints::where('project_id', $project_id)->get() as $systemSafetyConstraint)
            <li class="item" id="systemsafetyconstraint-{{$systemSafetyConstraint->id}}">
                <div class="item__title">
                    SSC-{{$systemSafetyConstraint->id}}: <input type="text" class="item__input" id="systemsafetyconstraint-description-{{$systemSafetyConstraint->id}}" value="{{$systemSafetyConstraint->name}}" disabled>
                    <div class="item__actions__action" id="accident-associated-1">
                        <a href="javascript:;" class="item__delete__box">×</a> [A-1]
                    </div>
                </div>
                <div class="item__actions">
                    <form action ="/editsystemsafetyconstraint" method="POST" class="edit-form ajaxform" data-edit="systemsafetyconstraint">
                        <div class="item__title">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <input id="project_id" name="project_id" type="hidden" value="1">
                            <input id="systemsafetyconstraint_id" name="systemsafetyconstraint_id" type="hidden" value="{{$systemSafetyConstraint->id}}">
                            <input type="image" src="{{ asset('images/edit.ico') }}" alt="Edit" width="20" class="navbar__logo">
                        </div>
                    </form>
                    <form action ="/deletesystemsafetyconstraint" method="POST" class="delete-form ajaxform" data-delete="systemsafetyconstraint">
                        <div class="item__title">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <input id="project_id" name="project_id" type="hidden" value="1">
                            <input id="systemsafetyconstraint_id" name="systemsafetyconstraint_id" type="hidden" value="{{$systemSafetyConstraint->id}}">
                            <input type="image" src="{{ asset('images/trash.png') }}" alt="Delete" width="20" class="navbar__logo">
                        </div>
                    </form>
                </div>
            </li>
        @endforeach
    </ul>
</div>