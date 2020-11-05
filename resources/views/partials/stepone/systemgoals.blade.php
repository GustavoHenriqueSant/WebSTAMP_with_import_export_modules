<div class="substep__title">
    System Goals&nbsp<i class="fa fa-question-circle" title=""></i>
</div>

<div class="substep__add" data-component="add-button" data-add="systemgoal">
    +
</div>

<div class="substep__content">
    <ul class="substep__list">
        @foreach (App\SystemGoals::where('project_id', $project_id)->get() as $systemGoal)
            <li class="item" id="systemgoal-{{$systemGoal->id}}">
                <div class="item__list">
                    <div class="item__title__textarea">
                        <label for="systemgoal-description-{{$systemGoal->id}}">G-{{$goals_map[$systemGoal->id]}}:</label>
                        <textarea maxlength="500" class="responsive_textarea" rows="1" id="systemgoal-description-{{$systemGoal->id}}" disabled>{{$systemGoal->name}}</textarea>
                    </div>

                    <div class="item__actions">

                        <div id="default-menu-systemgoal-{{$systemGoal->id}}">
                            <div class="item__title">
                                <input type="image" id="edit-systemgoal-{{$systemGoal->id}}" name="{{$systemGoal->id}}" src="{{ asset('images/edit.ico') }}" alt="Edit-systemgoal" width="20" class="navbar__logo edit-btn">
                            </div>
                             

                            <form action ="/deletesystemgoal" method="POST" class="delete-form ajaxform" data-delete="systemgoal">
                                <div class="item__title">
                                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                                    <input id="project_id" name="project_id" type="hidden" value="1">
                                    <input id="systemgoal_id" name="systemgoal_id" type="hidden" value="{{$systemGoal->id}}">
                                    <input type="image" src="{{ asset('images/trash.png') }}" alt="Delete" width="20" class="navbar__logo">
                                </div>
                            </form>
                        </div>

                        <div id="edition-menu-systemgoal-{{$systemGoal->id}}" style="display: none;">
                             <form action ="/editsystemgoal" method="POST" class="edit-form ajaxform" data-edit="systemgoal">
                                <div class="item__title">
                                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                                    <input id="project_id" name="project_id" type="hidden" value="1">
                                    <input id="systemgoal_id" name="systemgoal_id" type="hidden" value="{{$systemGoal->id}}">
                                    <input type="image" id="save-systemgoal-{{$systemGoal->id}}" src="{{ asset('images/save.ico') }}" alt="Edit" width="20" class="navbar__logo">
                                </div>
                            </form>
                            
                            <div class="item__title">
                                <input type="image" id="cancel-edit-systemgoal-{{$systemGoal->id}}" name="{{$systemGoal->id}}" src="{{ asset('images/delete.ico') }}" alt="Cancel-systemgoal" width="20" class="navbar__logo cancel-edit-btn">
                            </div>
                             
                        </div> 
                    </div>
                </div>
            </li>
        @endforeach
    </ul>
</div>
