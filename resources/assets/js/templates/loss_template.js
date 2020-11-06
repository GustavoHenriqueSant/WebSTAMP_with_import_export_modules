module.exports = function(context, exihibition_id) {
    console.log(context);
    var size = context.name.length;
    return `
        <li class="item" id="loss-${context.id}">
                <div class="item__list">
                    <div class="item__title__textarea">
                        <label for="loss-description-${context.id}">L-${exihibition_id}:</label>
                        <textarea maxlength="500" class="responsive_textarea" rows="1" id="loss-description-${context.id}" disabled>${context.name}</textarea>
                    </div>

                    <div class="item__actions">

                        <div id="default-menu-loss-${context.id}">
                                <div class="item__title">
                                    <input type="image" id="ediloss->id}}" name="${context.id}" src="/images/edit.ico" alt="Edit-loss" width="20" class="navbar__logo edit-btn">
                                </div>
                                 

                                <form action ="/deleteassumption" method="POST" class="delete-form ajaxform" data-delete="loss">
                                    <div class="item__title">
                                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                                        <input id="project_id" name="project_id" type="hidden" value="1">
                                        <input id="loss_id" name="loss_id" type="hidden" value="${context.id}">
                                        <input type="image" src="/images/trash.png" alt="Delete" width="20" class="navbar__logo">
                                    </div>
                                </form>
                            </div>

                            <div id="edition-menu-loss-${context.id}" style="display: none;">
                                 <form action ="/editassumption" method="POST" class="edit-form ajaxform" data-edit="loss">
                                    <div class="item__title">
                                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                                        <input id="project_id" name="project_id" type="hidden" value="1">
                                        <input id="loss_id" name="loss_id" type="hidden" value="${context.id}">
                                        <input type="image" id="save-loss-${context.id}" src="/images/save.ico" alt="Edit" width="20" class="navbar__logo">
                                    </div>
                                </form>
                                
                                <div class="item__title">
                                    <input type="image" id="cancel-edit-loss-${context.id}" name="${context.id}" src="/images/delete.ico" alt="Cancel-loss" width="20" class="navbar__logo cancel-edit-btn">
                                </div>
                            </div> 
                    </div>
                </div>
            </li>`;
};
