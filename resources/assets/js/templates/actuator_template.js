module.exports = function(context) {
    var size = context.name.length;
    return `
        <button class="accordion"><b>[Actuator]</b> ${context.name}</button>
        <div class="panel">
            <ul class="substep__list" id="add-actuator">
                <li class="item" id="actuator-${context.id}">
                    <div class="item__title">
                        ${context.name}
                    </div>
                    <div class="item__actions">
                        <form action ="/editactuator" method="POST" class="edit-form ajaxform" data-edit="actuator">
                            <div class="item__title">
                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                <input id="project_id" name="project_id" type="hidden" value="1">
                                <input id="component_id" name="component_id" type="hidden" value="${context.id}">
                                <input type="image" src="/images/edit.ico" alt="Edit" width="20" class="navbar__logo">
                            </div>
                        </form>
                        <form action ="/deleteactuator" method="POST" class="delete-form ajaxform" data-delete="actuator">
                            <div class="item__title">
                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                <input id="project_id" name="project_id" type="hidden" value="1">
                                <input id="component_id" name="component_id" type="hidden" value="${context.id}">
                                <input type="image" src="/images/trash.png" alt="Delete" width="20" class="navbar__logo">
                            </div>
                        </form>
                    </div>
                </li>
            </ul>
        </div>`;
};
