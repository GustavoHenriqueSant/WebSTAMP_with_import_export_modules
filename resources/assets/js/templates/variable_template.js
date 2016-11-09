module.exports = function(context) {
    var size = context.name.length;
    var statesList = "";
    context.states.forEach(function(value, index) {
        statesList += `<div class="item__actions__action" id="state-associated-`+ value.id +`">
                        <a href="javascript:;" class="item__delete__box" data-type="variable" data-index="`+ value.id +`">×</a> `+ value.name +`
                    </div>`;
    });
    return `
        <li class="item" id="variable-${context.id}">
                <div class="item__title">
                    <input type="text" class="item__input" id="variable-description-${context.id}" value="${context.name}" size="${size}" disabled>
                </div>
                ` + statesList + `
                <div class="item__actions__add" style="display: none;" id="state-variable-${context.id}">
                    <input type="image" src="/images/plus.png" alt="Add State" width=13" class="navbar__logo">
                </div>
                <div class="item__actions">
                    <form action ="/editvariable" method="POST" class="edit-form ajaxform" data-edit="variable">
                        <div class="item__title">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <input id="project_id" name="project_id" type="hidden" value="1">
                            <input id="variable_id" name="variable_id" type="hidden" value="${context.id}">
                            <input type="image" src="images/edit.ico" alt="Edit" width="20" class="navbar__logo">
                        </div>
                    </form>
                    <form action ="/deletevariable" method="POST" class="delete-form ajaxform" data-delete="variable">
                        <div class="item__title">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <input id="project_id" name="project_id" type="hidden" value="1">
                            <input id="variable_id" name="variable_id" type="hidden" value="${context.id}">
                            <input type="image" src="images/delete.ico" alt="Delete" width="20" class="navbar__logo">
                        </div>
                    </form>
                </div>
            </li>`;
};
