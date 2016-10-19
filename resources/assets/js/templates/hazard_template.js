module.exports = function(context) {
    var size = context.name.length;
    var accidents_associated = "";
    context.accidents_associated.forEach(function(value){
        accidents_associated += `<div class="item__actions__action">
                [A-`+value+`]
            </div>`;
    });
    return `
        <li class="item" id="hazard-${context.id}">
            <div class="item__title">
                H-${context.id}: <input type="text" class="item__input" id="hazard-description-${context.id}" value="${context.name}" size="${size}" onkeyup="this.size=this.value.length">
            </div>
            ${accidents_associated}
            <div class="item__actions">
                <form action ="/edit-formhazard" method="POST" class="edit-form ajaxform" data-edit="hazard">
                    <div class="item__title">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <input id="project_id" name="project_id" type="hidden" value="1">
                        <input id="hazard_id" name="hazard_id" type="hidden" value="${context.id}">
                        <input type="image" src="/images/edit.ico" alt="Edit" width="20" class="navbar__logo">
                    </div>
                </form>
                <form action ="/deletehazard" method="POST" class="delete-form ajaxform" data-delete="hazard">
                    <div class="item__title">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <input id="project_id" name="project_id" type="hidden" value="1">
                        <input id="hazard_id" name="hazard_id" type="hidden" value="${context.id}">
                        <input type="image" src="/images/delete.ico" alt="Delete" width="20" class="navbar__logo">
                    </div>
                </form>
            </div>
        </li>`;
};