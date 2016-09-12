module.exports = function(context, variable_name) {
    return `
        <li class="item">
                <div class="item__title">
                    ${context.name}
                </div>
                <div class="item__actions__action">
                    ${variable_name}
                </div>
                <div class="item__actions">
                    <div class="item__title">
                        <img src="/images/edit.ico" alt="Edit" width="20" class="navbar__logo">
                    </div>
                    <div class="item__title">
                        <img src="/images/delete.ico" alt="Delete" width="20" class="navbar__logo">
                    </div>
                </div>
            </li>`;
};