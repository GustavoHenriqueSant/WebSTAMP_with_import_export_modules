module.exports = function(context, exihibition_id) {
    var size = context.name.length;
    return `
        <li class="item" id="assumption-${context.id}">
                <div class="item__list">
                    <div class="item__title__textarea">
                        <label for="assumption-description-${context.id}">A-${exihibition_id}:</label>
                        <textarea maxlength="500" class="responsive_textarea" rows="1" id="assumption-description-${context.id}" disabled>${context.name}</textarea>
                    </div>
                    <div class="item__actions">

                        <div id="default-menu-assumption-${context.id}">
                            <div class="item__title">
                                <input type="image" id="edit-assumption-${context.id}" name="${context.id}" src="/images/edit.ico" alt="edit-assumption" width="20" class="navbar__logo edit-btn">
                            </div>
                             

                            <form action ="/deleteassumption" method="POST" class="delete-form ajaxform" data-delete="assumption">
                                <div class="item__title">
                                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                                    <input id="project_id" name="project_id" type="hidden" value="1">
                                    <input id="assumption_id" name="assumption_id" type="hidden" value="${context.id}">
                                    <input type="image" src="/images/trash.png" alt="Delete" width="20" class="navbar__logo">
                                </div>
                            </form>
                        </div>

                        <div id="edition-menu-assumption-${context.id}" style="display: none;">
                             <form action ="/editassumption" method="POST" class="edit-form ajaxform" data-edit="assumption">
                                <div class="item__title">
                                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                                    <input id="project_id" name="project_id" type="hidden" value="1">
                                    <input id="assumption_id" name="assumption_id" type="hidden" value="${context.id}">
                                    <input type="image" id="save-assumption-${context.id}" src="/images/save.ico" alt="Edit" width="20" class="navbar__logo">
                                </div>
                            </form>
                            
                            <div class="item__title">
                                <input type="image" id="cancel-edit-assumption-${context.id}" name="${context.id}" src="/images/delete.ico" alt="Cancel-assumption" width="20" class="navbar__logo cancel-edit-btn">
                            </div>
                             
                        </div> 
                    </div>
                </div>
            </li>`;

        
};
