module.exports = function(context) {
    var size = context.name.length;
    return `
        <li class="item" id="loss-${context.id}">
            <div class="item__title">
                A-${context.id}: <input type="text" class="item__input" id="loss-description-${context.id}" value="${context.name}" size="${size}" onkeypress="this.size=this.value.length" disabled>
            </div>
            <div class="item__actions">
                <form action ="/editloss" method="POST" class="edit-form ajaxform" data-edit="loss">
                    <div class="item__title">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <input id="project_id" name="project_id" type="hidden" value="1">
                        <input id="loss_id" name="loss_id" type="hidden" value="${context.id}">
                        <input type="image" src="/images/edit.ico" alt="Edit" width="20" class="navbar__logo">
                    </div>
                </form>
                <form action ="/deleteloss" method="POST" class="delete-form ajaxform" data-delete="loss">
                    <div class="item__title">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <input id="project_id" name="project_id" type="hidden" value="1">
                        <input id="loss_id" name="loss_id" type="hidden" value="${context.id}">
                        <input type="image" src="/images/trash.png" alt="Delete" width="20" class="navbar__logo">
                    </div>
                </form>
            </div>
        </li>`;
};
