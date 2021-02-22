module.exports = function(context, exihibition_id, losses, losses_map) {
    var size = context.name.length;

    var list_of_losses = "";

    losses.forEach(function(f, index){
        list_of_losses += `<a class="hazard_loss_association" id="hazard_loss_${context.id}_${f}">${losses_map[f]}</a>&nbsp&nbsp`;
    });

    return `
            <li class="item" id="hazard-${context.id}">

                <div class="item__list">

                    <ul class="substep__itens">
                        <li class="step1_itens">

                            <div class="item__title__textarea">
                                <label for="hazard-description-${context.id}">H-${exihibition_id}:</label>
                                <textarea maxlength="500" class="responsive_textarea" rows="1" id="hazard-description-${context.id}" disabled>${context.name}</textarea>
                            </div>

                            <div class="item__actions">

                                <div id="default-menu-hazard-${context.id}">
                                    <div class="item__title">
                                        <input type="image" id="edit-hazard-${context.id}" name="${context.id}" src="/images/edit.ico" alt="Edit-hazard" width="20" class="navbar__logo edit-btn">
                                    </div>
                                     

                                    <form action ="/deletehazard" method="POST" class="delete-form ajaxform" data-delete="hazard">
                                        <div class="item__title">
                                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                                            <input id="project_id" name="project_id" type="hidden" value="1">
                                            <input id="hazard_id" name="hazard_id" type="hidden" value="${context.id}">
                                            <input type="image" src="/images/trash.png" alt="Delete" width="20" class="navbar__logo">
                                        </div>
                                    </form>
                                </div>

                                <div id="edition-menu-hazard-${context.id}" style="display: none;">
                                     <form action ="/edithazard" method="POST" class="edit-form ajaxform" data-edit="hazard">
                                        <div class="item__title">
                                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                                            <input id="project_id" name="project_id" type="hidden" value="1">
                                            <input id="hazard_id" name="hazard_id" type="hidden" value="${context.id}">
                                            <input type="image" id="save-hazard-${context.id}" src="/images/save.ico" alt="Edit" width="20" class="navbar__logo">
                                        </div>
                                    </form>
                                    
                                    <div class="item__title">
                                        <input type="image" id="cancel-edit-hazard-${context.id}" name="${context.id}" src="/images/delete.ico" alt="Cancel-hazard" width="20" class="navbar__logo cancel-edit-btn">
                                    </div>
                                     
                                </div> 
                            </div>
                        </li>
                        <li class="step1_itens">
                            <div id="hazard_loss_association-${context.id}" hidden="true">
                                <label id="label_hazard-${context.id}" class="hidden">H-${exihibition_id}:</label>
                                <select id="hazard_loss-${context.id}" name="hazard_loss" class="select_from_form_ssc" multiple required title="" size="3">     
                                </select>
                            </div>

                            <div id="hazard_${context.id}_losses"style="margin: 0 0 15px 0;">    
                                ${list_of_losses}
                            </div>

                            <input hidden id="hazard_${context.id}_losses_associated" value="${losses}">

                        </li>
                    </ul>
                </div>
            </li>`;
};