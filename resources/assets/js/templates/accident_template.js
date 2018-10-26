module.exports = function(context, exihibition_id) {
    console.log(context);
    var size = context.name.length;
    return `
        <li class="item" id="accident-${context.id}">
            <div class="item__title">
                L-${exihibition_id}: <input type="text" class="item__input" id="accident-description-${context.id}" value="${context.name}" size="${size}" onkeypress="this.size=this.value.length" disabled>
            </div>
            <div class="item__actions">
                <form action ="/editaccident" method="POST" class="edit-form ajaxform" data-edit="accident">
                    <div class="item__title">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <input id="project_id" name="project_id" type="hidden" value="1">
                        <input id="accident_id" name="accident_id" type="hidden" value="${context.id}">
                        <input type="image" src="/images/edit.ico" alt="Edit" width="20" class="navbar__logo">
                    </div>
                </form>
                <form action ="/deleteaccident" method="POST" class="delete-form ajaxform" data-delete="accident">
                    <div class="item__title">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <input id="project_id" name="project_id" type="hidden" value="1">
                        <input id="accident_id" name="accident_id" type="hidden" value="${context.id}">
                        <input type="image" src="/images/trash.png" alt="Delete" width="20" class="navbar__logo">
                    </div>
                </form>
            </div>
        </li>`;
};
