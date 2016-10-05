module.exports = function(context) {
    return `
        <li class="item" id="hazard-${context.id}">
            <div class="item__title">
                H-${context.id}: ${context.name}
            </div>
            <div class="item__actions__action">
                [A-1]
            </div>
            <div class="item__actions">
                <div class="item__title">
                    <img src="/images/edit.ico" alt="Edit" width="20" class="navbar__logo">
                </div>
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