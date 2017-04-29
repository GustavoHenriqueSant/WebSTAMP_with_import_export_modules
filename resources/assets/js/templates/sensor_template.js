module.exports = function(context) {
    var size = context.name.length;
    return `
        <button class="accordion"><b>[Sensor]</b> ${context.name}</button>
        <div class="panel">
            <ul class="substep__list" id="add-sensor">
                <li class="item" id="sensor-${context.id}">
                    <div class="item__title">
                        ${context.name}
                    </div>
                    <div class="item__actions">
                        <form action ="/editsensor" method="POST" class="edit-form ajaxform" data-edit="sensor">
                            <div class="item__title">
                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                <input id="project_id" name="project_id" type="hidden" value="1">
                                <input id="component_id" name="component_id" type="hidden" value="${context.id}">
                                <input type="image" src="/images/edit.ico" alt="Edit" width="20" class="navbar__logo">
                            </div>
                        </form>
                        <form action ="/deletesensor" method="POST" class="delete-form ajaxform" data-delete="sensor">
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
