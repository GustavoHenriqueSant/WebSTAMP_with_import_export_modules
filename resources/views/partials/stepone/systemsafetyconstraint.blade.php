<div class="substep__title">
    @if($project_type == "Safety")
        System-level Safety Constraints
    @else
        System-level Security Constraints
    @endif
    &nbsp<i class="fa fa-question-circle" title="A system-level constraint specifies system conditions or behaviors that need to be satisfied to prevent hazards (and ultimately prevent losses). (STPA Handbook, p. 20)"></i>
</div>

<div class="substep__add" data-component="add-button" data-add="systemsafetyconstraint">
    +
</div>

<div class="substep__content" id="ssc_content" data-hazards="{{$hazards}}">
    <ul class="substep__list">
        @foreach (App\SystemSafetyConstraints::where('project_id', $project_id)->get() as $systemSafetyConstraint)
            <li class="item" id="systemsafetyconstraint-{{$systemSafetyConstraint->id}}">

                <div class="item__list">
                     <ul class="substep__itens">
                        <li class="step1_itens">

                             <div class="item__title__textarea">
                                <label id="label_systemsafetyconstraint-{{$systemSafetyConstraint->id}}" for="systemsafetyconstraint-description-{{$systemSafetyConstraint->id}}">SSC-{{$sysconstraints_map[$systemSafetyConstraint->id]}}:</label>
                                <textarea maxlength="500" class="responsive_textarea" rows="1" id="systemsafetyconstraint-description-{{$systemSafetyConstraint->id}}" disabled>{{$systemSafetyConstraint->name}}</textarea>

                            </div>

                            <div class="item__actions">

                                <div id="default-menu-systemsafetyconstraint-{{$systemSafetyConstraint->id}}">
                                    <div class="item__title">
                                        <input type="image" id="edit-systemsafetyconstraint-{{$systemSafetyConstraint->id}}" name="{{$systemSafetyConstraint->id}}" src="{{ asset('images/edit.ico') }}" alt="Edit-systemsafetyconstraint" width="20" class="navbar__logo edit-btn">
                                    </div>
                                     

                                    <form action ="/deletesystemsafetyconstraint" method="POST" class="delete-form ajaxform" data-delete="systemsafetyconstraint">
                                        <div class="item__title">
                                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                                            <input id="project_id" name="project_id" type="hidden" value="1">
                                            <input id="systemsafetyconstraint_id" name="systemsafetyconstraint_id" type="hidden" value="{{$systemSafetyConstraint->id}}">
                                            <input type="image" src="{{ asset('images/trash.png') }}" alt="Delete" width="20" class="navbar__logo">
                                        </div>
                                    </form>
                                </div>

                                <div id="edition-menu-systemsafetyconstraint-{{$systemSafetyConstraint->id}}" style="display: none;">
                                     <form action ="/editsystemsafetyconstraint" method="POST" class="edit-form ajaxform" data-edit="systemsafetyconstraint">
                                        <div class="item__title">
                                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                                            <input id="project_id" name="project_id" type="hidden" value="1">
                                            <input id="systemsafetyconstraint_id" name="systemsafetyconstraint_id" type="hidden" value="{{$systemSafetyConstraint->id}}">
                                            <input type="image" id="save-systemsafetyconstraint-{{$systemSafetyConstraint->id}}" src="{{ asset('images/save.ico') }}" alt="Edit" width="20" class="navbar__logo">
                                        </div>
                                    </form>
                                    
                                    <div class="item__title">
                                        <input type="image" id="cancel-edit-systemsafetyconstraint-{{$systemSafetyConstraint->id}}" name="{{$systemSafetyConstraint->id}}" src="{{ asset('images/delete.ico') }}" alt="Cancel-systemsafetyconstraint" width="20" class="navbar__logo cancel-edit-btn">
                                    </div>
                                     
                                </div> 
                            </div>
                         </li>
                        <li class="step1_itens">
                            <div id="ssc_hazard_association-{{$systemSafetyConstraint->id}}" hidden="true">
                                <label id="label_systemsafetyconstraint-{{$systemSafetyConstraint->id}}" class="hidden">SSC-{{$sysconstraints_map[$systemSafetyConstraint->id]}}:</label>
                                <select id="ssc_hazard-{{$systemSafetyConstraint->id}}" name="ssc_hazard" class="select_from_form_ssc" multiple required title="" size="3">     
                                </select>
                            </div>
                            <div id="ssc_{{$systemSafetyConstraint->id}}_hazards"style="margin: 0 0 15px 0;">
                                <?php $associated_hazards = array(); ?>
                                @foreach(App\SystemSafetyConstraintHazards::where('ssc_id', $systemSafetyConstraint->id)->get() as $ssc_hazard)
                                    <?php array_push($associated_hazards, $ssc_hazard->hazard_id); ?>
                                    <a class="ssc_hazard_association" id="ssc_hazard_{{$ssc_hazard->ssc_id}}_{{$ssc_hazard->hazard_id}}">
                                    [H-{{$hazard_map[$ssc_hazard->hazard_id]}}]</a>&nbsp
                                @endforeach

                                 <?php
                                    $ids = ""; 
                                    foreach ($associated_hazards as $index => $id) {
                                        if($index  != count($associated_hazards) - 1)
                                            $ids .= $id.",";
                                        else
                                            $ids .= $id;
                                    }
                                ?>
                            </div>

                            <input hidden id="ssc_{{$systemSafetyConstraint->id}}_hazards_associated" value= <?php echo($ids); ?>>

                        </li>
                     </ul>
                </div>
            </li>
        @endforeach
    </ul>
</div>