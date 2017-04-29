module.exports = function(context) {
    var size = context.name.length;
    return `
        <li class="item" id="systemsafetyconstraint-${context.id}">
                <div class="item__title">
                    SSC-${context.id}: <input type="text" class="item__input" id="systemsafetyconstraint-description-${context.id}" value="${context.name}" size="${size}" onkeypress="this.size=this.value.length" disabled>
                </div>
                <div class="item__actions">
	                <form action="editsystemsafetyconstraint" method="POST"  class="edit-form ajaxform" data-edit="systemsafetyconstraint">
                       <div class="item__title">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <input id="project_id" name="project_id" type="hidden" value="1">
                            <input id="systemsafetyconstraint_id" name="systemsafetyconstraint_id" type="hidden" value="${context.id}">
                            <input type="image" src="/images/edit.ico" alt="Edit" width="20" class="navbar__logo">
	                   </div>
                    </form>
                    <form action="deletesystemsafetyconstraint" method="POST"  class="delete-form ajaxform" data-delete="systemsafetyconstraint">
	                   <div class="item__title">
	                       <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <input id="project_id" name="project_id" type="hidden" value="1">
                            <input id="systemsafetyconstraint_id" name="systemsafetyconstraint_id" type="hidden" value="${context.id}">
                            <input type="image" src="/images/trash.png" alt="Delete" width="20" class="navbar__logo">
	                   </div>
                    </form>
             	</div>
        </li>`;
};
