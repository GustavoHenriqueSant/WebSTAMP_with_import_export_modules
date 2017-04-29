module.exports = function(context) {
    return `
        <li class="item" id="connection-${context.id}">
            <div class="item__title">
                ${context.input_name} → ${context.output_name}
            </div>
            <div class="item__actions">

                <form action ="/deleteconnections" method="POST" class="delete-form ajaxform" data-delete="connection">
                    <div class="item__title">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <input id="project_id" name="project_id" type="hidden" value="1">
                        <input id="connection_id" name="connection_id" type="hidden" value="${context.id}">
                        <input type="image" src="/images/trash.png" alt="Delete" width="20" class="navbar__logo">
                    </div>
                </form>
            </div>
        </li>`;
};


/*
                <form action ="/editconnections" method="POST" class="edit-form ajaxform" data-edit="connections">
                    <div class="item__title">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <input id="project_id" name="project_id" type="hidden" value="1">
                        <input id="connection_id" name="connection_id" type="hidden" value="${context.id}">
                        <input type="image" src="/images/edit.ico" alt="Edit" width="20" class="navbar__logo">
                    </div>
                </form>
*/
