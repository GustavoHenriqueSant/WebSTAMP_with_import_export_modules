module.exports = function(context, exihibition_id) {
    var size = context.name.length;
    return `
        <li class="item" id="assumption-${context.id}">
                <div class="item__title">
                    A-${exihibition_id}: <br/> <textarea class="item__textarea" id="assumption-description-${context.id}"  rows="5" cols = "100" style="resize: none;
    height: auto;" disabled>${context.name}</textarea>
                </div>
                <div class="item__actions">
                    <form action ="/editassumption" method="POST" class="edit-form ajaxform" data-edit="assumption">
                        <div class="item__title">
                           <input id="project_id" name="project_id" type="hidden" value="1">
                            <input id="assumption_id" name="assumption_id" type="hidden" value="${context.id}">
                            <input type="image" src="/images/edit.ico" alt="Edit" width="20" class="navbar__logo">
                       </div>
                    </form>
                    <form action="deleteassumption" method="POST"  class="delete-form ajaxform" data-delete="assumption">
                       <div class="item__title">
                           <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <input id="project_id" name="project_id" type="hidden" value="1">
                            <input id="assumption_id" name="assumption_id" type="hidden" value="${context.id}">
                            <input type="image" src="/images/trash.png" alt="Delete" width="20" class="navbar__logo">
                       </div>
                    </form>
                </div>
        </li>`;
};
