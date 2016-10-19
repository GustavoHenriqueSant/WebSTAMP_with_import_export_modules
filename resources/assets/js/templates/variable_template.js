module.exports = function(context) {
    var size = context.name.length;
    return `
        <li class="item">
                <div class="item__title">
                    <input type="text" class="item__input" id="variable-description-${context.id}" value="${context.name}" size="${size}" onkeypress="this.size=this.value.length">
                </div>
                <div class="item__actions">
	                <form action ="/editvariable" method="POST" class="edit-form ajaxform" data-delete="variable">
                        <div class="item__title">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <input id="project_id" name="project_id" type="hidden" value="1">
                            <input id="variable_id" name="variable_id" type="hidden" value="${context.id}">
                            <input type="image" src="/images/edit.ico" alt="Edit" width="20" class="navbar__logo">
                        </div>
                    </form>
                    <form action ="/deletevariable" method="POST" class="delete-form ajaxform" data-delete="variable">
                        <div class="item__title">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <input id="project_id" name="project_id" type="hidden" value="1">
                            <input id="variable_id" name="variable_id" type="hidden" value="${context.id}">
                            <input type="image" src="/images/delete.ico" alt="Delete" width="20" class="navbar__logo">
                        </div>
                    </form>
             	</div>
        </li>`;
};
