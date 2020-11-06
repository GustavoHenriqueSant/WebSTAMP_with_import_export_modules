module.exports = function(context, exihibition_id) {
    var size = context.name.length;
    return `
        <li class="item" id="systemgoal-${context.id}">
                <div class="item__list">
                    <div class="item__title__textarea">
                        <label for="systemgoal-description-${context.id}">G-${exihibition_id}:</label>
                        <textarea maxlength="500" class="responsive_textarea" rows="1" id="systemgoal-description-${context.id}" disabled>${context.name}</textarea>
                    </div>

                    <div class="item__actions">

                        <div id="default-menu-systemgoal-${context.id}">
                            <div class="item__title">
                                <input type="image" id="edit-systemgoal-${context.id}" name="${context.id}" src="/images/edit.ico" alt="Edit-systemgoal" width="20" class="navbar__logo edit-btn">
                            </div>
                             

                            <form action ="/deletesystemgoal" method="POST" class="delete-form ajaxform" data-delete="systemgoal">
                                <div class="item__title">
                                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                                    <input id="project_id" name="project_id" type="hidden" value="1">
                                    <input id="systemgoal_id" name="systemgoal_id" type="hidden" value="${context.id}">
                                    <input type="image" src="/images/trash.png" alt="Delete" width="20" class="navbar__logo">
                                </div>
                            </form>
                        </div>

                        <div id="edition-menu-systemgoal-${context.id}" style="display: none;">
                             <form action ="/editsystemgoal" method="POST" class="edit-form ajaxform" data-edit="systemgoal">
                                <div class="item__title">
                                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                                    <input id="project_id" name="project_id" type="hidden" value="1">
                                    <input id="systemgoal_id" name="systemgoal_id" type="hidden" value="${context.id}">
                                    <input type="image" id="save-systemgoal-${context.id}" src="/images/save.ico" alt="Edit" width="20" class="navbar__logo">
                                </div>
                            </form>
                            
                            <div class="item__title">
                                <input type="image" id="cancel-edit-systemgoal-${context.id}" name="${context.id}" src="/images/delete.ico" alt="Cancel-systemgoal" width="20" class="navbar__logo cancel-edit-btn">
                            </div>
                             
                        </div> 
                    </div>
                </div>
            </li>`;
};
