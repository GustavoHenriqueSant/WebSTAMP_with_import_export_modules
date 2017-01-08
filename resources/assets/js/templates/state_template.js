module.exports = function(context, id_or_class) {
    if (id_or_class)
        return `
            <div class="item__actions__action" id="state-associated-${context.id}">
                <a href="javascript:;" class="item__delete__box" data-type="variable" data-index="${context.id}">×</a> ${context.name}
            </div>`;
    else
        return `
            <div class="item__actions__action state-associated-${context.id}">
                ${context.name}
            </div>`;
    };