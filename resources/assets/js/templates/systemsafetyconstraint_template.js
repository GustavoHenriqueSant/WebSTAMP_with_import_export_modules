module.exports = function(context, exihibition_id, hazards, hazards_map) {
    var size = context.name.length;

    var list_of_hazards = "";

    hazards.forEach(function(f, index){
        if(hazards.length > 1)
            list_of_hazards += `<a class="ssc_hazard_association" id="ssc_hazard_${context.id}_${f}"><span class="delete_step1_association delete_ssc_hazard_association_${context.id}" alt="systemSafetyConstraintHazardAssociation" name="ids-${context.id}-${f}">×</span> ${hazards_map[f]}</a>&nbsp&nbsp`;
        else
            list_of_hazards += `<a class="ssc_hazard_association" id="ssc_hazard_${context.id}_${f}"><span style="display:none;" class="delete_step1_association delete_ssc_hazard_association_${context.id}" alt="systemSafetyConstraintHazardAssociation" name="ids-${context.id}-${f}">×</span> ${hazards_map[f]}</a>&nbsp&nbsp`;
    });

    return `
            <li class="item" id="systemsafetyconstraint-${context.id}">

                <div class="item__list">
                    <ul class="substep__itens">
                        <li class="step1_itens">
                             <div class="item__title__textarea">
                                <label for="systemsafetyconstraint-description-${context.id}">SSC-${exihibition_id}:</label>
                                <textarea maxlength="500" class="responsive_textarea" rows="1" id="systemsafetyconstraint-description-${context.id}" disabled>${context.name}</textarea>
                            </div>

                            <div class="item__actions">

                                <div id="default-menu-systemsafetyconstraint-${context.id}">
                                    <div class="item__title">
                                        <input type="image" id="edit-systemsafetyconstraint-${context.id}" name="${context.id}" src="/images/edit.ico" alt="Edit-systemsafetyconstraint" width="20" class="navbar__logo edit-btn">
                                    </div>
                                     

                                    <form action ="/deletesystemsafetyconstraint" method="POST" class="delete-form ajaxform" data-delete="systemsafetyconstraint">
                                        <div class="item__title">
                                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                                            <input id="project_id" name="project_id" type="hidden" value="1">
                                            <input id="systemsafetyconstraint_id" name="systemsafetyconstraint_id" type="hidden" value="${context.id}">
                                            <input type="image" src="/images/trash.png" alt="Delete" width="20" class="navbar__logo">
                                        </div>
                                    </form>
                                </div>

                                <div id="edition-menu-systemsafetyconstraint-${context.id}" style="display: none;">
                                     <form action ="/editsystemsafetyconstraint" method="POST" class="edit-form ajaxform" data-edit="systemsafetyconstraint">
                                        <div class="item__title">
                                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                                            <input id="project_id" name="project_id" type="hidden" value="1">
                                            <input id="systemsafetyconstraint_id" name="systemsafetyconstraint_id" type="hidden" value="${context.id}">
                                            <input type="image" id="save-systemsafetyconstraint-${context.id}" src="/images/save.ico" alt="Edit" width="20" class="navbar__logo">
                                        </div>
                                    </form>
                                    
                                    <div class="item__title">
                                        <input type="image" id="cancel-edit-systemsafetyconstraint-${context.id}" name="${context.id}" src="/images/delete.ico" alt="Cancel-systemsafetyconstraint" width="20" class="navbar__logo cancel-edit-btn">
                                    </div>
                                     
                                </div> 
                            </div>
                        </li>

                        <li class="step1_itens">

                            <div id="ssc_${context.id}_hazards"style="margin: 0 0 15px 0;">
                             
                                ${list_of_hazards}

                                <!-- <input id="hazards-associated-with-" type="hidden" name="_token" value="${hazards}" > --!>
                                <!-- <input id="add-hazard-association-${context.id}" value="${context.id}" type="image" src="/images/plus.png" alt="Add State" width="13" class="navbar__logo add-hazard-association"  style="display: none;"> --!>
                            </div>
                        </li>
                    </ul>

                </div>
            </li>`;
};


