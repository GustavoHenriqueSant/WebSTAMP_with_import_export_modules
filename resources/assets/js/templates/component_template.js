module.exports = function(context) {
    var type = context.type.toLowerCase();
    return `
        <li class="item" id="${type}-${context.id}">
            <div class="item__title">
                ${context.name}
            </div>
            <div class="item__actions">
                <div class="item__title">
                    <img src="/images/edit.ico" alt="Edit" width="20" class="navbar__logo">
                </div>
                <form action ="/deletecomponent" method="POST" class="delete-form ajaxform" data-delete="component">
                    <div class="item__title">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <input id="project_id" name="project_id" type="hidden" value="1">
                        <input id="component_id" name="component_id" type="hidden" value="${context.id}">
                        <input type="image" src="/images/trash.png" alt="Delete" width="20" class="navbar__logo">
                    </div>
                </form>
            </div>
        </li>`;
};
