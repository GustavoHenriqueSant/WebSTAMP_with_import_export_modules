module.exports = function(context) {
    var size = context.name.length;
    return `
        <li class="item" id="systemgoal-${context.id}">
                <div class="item__title">
                    G-${context.id}: <input type="text" class="item__input" id="systemgoal-description-${context.id}" value="${context.name}" size="${size}" onkeypress="this.size=this.value.length">
                </div>
                <div class="item__actions">
	                <form action ="/editsystemgoal" method="POST" class="edit-form ajaxform" data-edit="systemgoal">
                        <div class="item__title">
	                       <input id="project_id" name="project_id" type="hidden" value="1">
                            <input id="systemgoal_id" name="systemgoal_id" type="hidden" value="${context.id}">
                            <input type="image" src="/images/edit.ico" alt="Edit" width="20" class="navbar__logo">
	                   </div>
                    </form>
                    <form action="deletesystemgoal" method="POST"  class="delete-form ajaxform" data-delete="systemgoal">
	                   <div class="item__title">
	                       <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <input id="project_id" name="project_id" type="hidden" value="1">
                            <input id="systemgoal_id" name="systemgoal_id" type="hidden" value="${context.id}">
                            <input type="image" src="/images/delete.ico" alt="Delete" width="20" class="navbar__logo">
	                   </div>
                    </form>
             	</div>
        </li>`;
};
