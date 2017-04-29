module.exports = function(context) {
    var size = context.name.length;
    return `
        <button class="accordion"><b>[Controlled Process]</b> ${context.name}</button>
        <div class="panel">
            <ul class="substep__list" id="add-controlledprocess">
                <li class="item" id="controlledprocess-${context.id}">
                    <div class="item__title">
                        ${context.name}
                    </div>
                    <div class="item__actions">
                        <form action ="/editcontrolledprocess method="POST" class="edit-form ajaxform" data-edit="controlledprocess">
                            <div class="item__title">
                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                <input id="project_id" name="project_id" type="hidden" value="1">
                                <input id="component_id" name="component_id" type="hidden" value="${context.id}">
                                <input type="image" src="/images/edit.ico" alt="Edit" width="20" class="navbar__logo">
                            </div>
                        </form>
                        <form action ="/deletecontrolledprocess" method="POST" class="delete-form ajaxform" data-delete="controlledprocess">
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
            <div class="substep substep--variables-associated" id="variables-0">
                <div class="substep__title">
                    System Variables
                </div>
                <div class="substep__add" data-component="add-button" data-add="variable-0">
                    +
                </div>
                <div class="substep__content variables-content" id=variable-0>
                    <ul class="substep__list">
                    </ul>
                </div>
            </div>
        </div>`;
};
