module.exports = function(context) {

    var uca_size = context.unsafe_control_action.length;
    var sc_size =  context.safety_constraint.length;

    var type = `<select id="type-${context.id}" style="-webkit-appearance: none; box-shadow: none !important; border: 0;" disabled>`;

    if (context.type === 'provided' || context.type === 'Provided')
        type += `<option value="Provided" selected>[Provided]</option>`;
    else
        type += `<option value="Provided">[Provided]</option>`;

    if (context.type === 'not provided' || context.type === 'Not provided')
        type += `<option value="Not Provided" selected>[Not Provided]</option>`;
    else
        type += `<option value="Not Provided">[Not Provided]</option>`;

    if (context.type === 'wrong time' || context.type === 'Provided in wrong time')
        type += `<option value="Wrong Time" selected>[Wrong Time]</option>`;
    else
        type += `<option value="Wrong Time">[Wrong Time]</option>`;

    if (context.type === 'wrong order' || context.type === 'Provided in wrong order')
        type += `<option value="Wrong Order" selected>[Wrong Order]</option>`;
    else
        type += `<option value="Wrong Order">[Wrong Order]</option>`;

    if (context.type === 'too early' || context.type === 'Provided too early')
        type += `<option value="Provided too early" selected>[Provided too early]</option>`;
    else
        type += `<option value="Provided too early">[Provided too early]</option>`;

    if (context.type === 'too late' || context.type === 'Provided too late')
        type += `<option value="Provided too late" selected>[Provided too late]</option>`;
    else
        type += `<option value="Provided too late">[Provided too late]</option>`;

    if (context.type === 'too soon' || context.type === 'Stopped too soon')
        type += `<option value="Stopped too soon" selected>[Stopped too soon]</option>`;
    else
        type += `<option value="Stopped too soon">[Stopped too soon]</option>`;

    if (context.type === 'too long' || context.type === 'Applied too long')
        type += `<option value="Applied too long" selected>[Applied too long]</option>`;
    else
        type += `<option value="Applied too long">[Applied too long]</option>`;

    type += `</select>`;

    return `
        <div class="table-row" id="uca-row-${context.id}">
                    
                    <div class="text">
                        <br/>
                        <textarea class="uca_list_textarea" id="unsafe_control_action-${context.id}" disabled>${context.unsafe_control_action}</textarea>
                    </div>
                    
                    <div class="text">
                        ${type}
                        <textarea class="uca_list_textarea" id="safety_constraint-${context.id}" disabled>${context.safety_constraint}</textarea>
                    </div>
                    
                    <div class="text center">
                        <div style="display: inline-block;">
                            <form action="/edituca" class="edit-form" data-edit="uca" method="POST" style="display: inline-block; float: left;">
                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                <input type="hidden" name="controlaction_id" id="controlaction_id" value="${context.id}">
                                <input type="hidden" name="safety_constraint_id" id="safety_constraint_id" value="${context.id}">
                                <input type="image" src="/images/edit.ico" alt="Delete" width="20" class="navbar__logo">
                            </form>
                            <form action="/deleteuca" class="delete-form" data-delete="uca" method="POST" style="display: inline-block; float: left;">
                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                <input type="hidden" name="controlaction_id" id="controlaction_id" value="${context.id}">
                                <input type="hidden" name="safety_constraint_id" id="safety_constraint_id" value="${context.id}">
                                <input type="image" src="/images/trash.png" alt="Delete" width="20" class="navbar__logo">
                            </form>
                        </div>
                    </div>
        </div>`;
};
