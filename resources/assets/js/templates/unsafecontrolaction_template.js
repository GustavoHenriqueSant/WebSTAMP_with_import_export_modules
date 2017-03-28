module.exports = function(context) {
    var type = `<select style="-webkit-appearance: none; box-shadow: none !important; border: 0; direction: rtl;" disabled>`;

    if (context.type === 'Provided')
        type += `<option value="Provided" selected>[Provided]</option>`;
    else
        type += `<option value="Provided">[Provided]</option>`;

    if (context.type === 'Not Provided')
        type += `<option value="Not Provided" selected>[Not Provided]</option>`;
    else
        type += `<option value="Not Provided">[Not Provided]</option>`;

    if (context.type === 'Wrong Time')
        type += `<option value="Wrong Time" selected>[Wrong Time]</option>`;
    else
        type += `<option value="Wrong Time">[Wrong Time]</option>`;

    if (context.type === 'Wrong Order')
        type += `<option value="Wrong Order" selected>[Wrong Order]</option>`;
    else
        type += `<option value="Wrong Order">[Wrong Order]</option>`;

    if (context.type === 'Provided too early')
        type += `<option value="Provided too early" selected>[Provided too early]</option>`;
    else
        type += `<option value="Provided too early">[Provided too early]</option>`;

    if (context.type === 'Provided too late')
        type += `<option value="Provided too late" selected>[Provided too late]</option>`;
    else
        type += `<option value="Provided too late">[Provided too late]</option>`;

    if (context.type === 'Stopped too soon')
        type += `<option value="Stopped too soon" selected>[Stopped too soon]</option>`;
    else
        type += `<option value="Stopped too soon">[Stopped too soon]</option>`;

    if (context.type === 'Applied too long')
        type += `<option value="Applied too long" selected>[Applied too long]</option>`;
    else
        type += `<option value="Applied too long">[Applied too long]</option>`;

    type += `</select>`;

    return `
        <div class="table-row" id="uca-row-${context.id}">
                    
                    <div class="text">
                        ${context.unsafe_control_action}
                    </div>
                    
                    <div class="text">
                        ${type}
                        ${context.safety_constraint}
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
