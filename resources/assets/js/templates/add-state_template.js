module.exports = function(context) {

    return `<div data-component="drop" data-drop="form-state-variable-${context.id}" class="add-drop">
        <form action ="/addstate-variable-${context.id}" method="POST" class="add-form" data-add="state-variable-${context.id}">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <input id="project_id" name="project_id" type="hidden" value="1">
            <div class="add-drop__content">
                <label for="state-name-${context.id}" class="add-drop__label">
                    State name
                </label>
                <input id="state-name-${context.id}" name="state-name-${context.id}" type="text" class="add-drop__input">
                <input type="hidden" name="variable_id" id="variable_id" value="${context.id}">
            </div>
            <div class="add-drop__buttons">
                    <button class="add-drop__action">
                      Cancel
                    </button>
                    <button type="submit" class="add-drop__action">
                      Add
                    </button>
            </div>
        </form>
    </div>`;
}