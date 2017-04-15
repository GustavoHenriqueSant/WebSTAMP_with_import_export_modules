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
                    
                    <div class="text item__title">
                        <input type="text" class="item__input" id="unsafe_control_action-${context.id}" value="${context.unsafe_control_action}" size="${uca_size}" disabled>
                    </div>
                    
                    <div class="text">
                        <div>
                            ${type}
                        </div>
                        <div class="item__title">
                            <input type="text" class="item__input" id="safety_constraint-${context.id}" value="${context.safety_constraint}" size="${sc_size}" disabled>
                        </div>
                    </div>
                    
                    <div>
                        <form action="/edituca" class="delete-form" data-delete="uca" method="POST">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <input type="hidden" name="controlaction_id" id="controlaction_id" value="{{$ca->id}}">
                            <input type="hidden" name="safety_constraint_id" id="safety_constraint_id" value="{{$sc->id}}">
                            <input type="image" src="/images/edit.ico" alt="Delete" width="20" class="navbar__logo">
                        </form>
                    </div>
                    <div>
                        <form action="/deleteuca" class="delete-form" data-delete="uca" method="POST">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <input type="hidden" name="controlaction_id" id="controlaction_id" value="{{$ca->id}}">
                            <input type="hidden" name="safety_constraint_id" id="safety_constraint_id" value="{{$sc->id}}">
                            <input type="image" src="/images/trash.png" alt="Delete" width="20" class="navbar__logo">
                        </form>
                    </div>
                </div>`;
};
