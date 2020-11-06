module.exports = function(context, associated_hazards, token) {

    var uca_size = context.unsafe_control_action.length;
    var sc_size =  context.safety_constraint.length;

    var hazards_tags = '';

    associated_hazards.forEach(function(hazard, index){
        var infos = hazard.split(':');
        var code = infos[0];
        var name = infos[1];
        hazards_tags += `<a class="uca_association" title="${name}">${code}</a>\n`
    });

    return `
        <div class="table-row" id="uca-row-${context.id}">
                    
                    <div class="text">
                        <br/>
                        <textarea class="uca_list_textarea" id="unsafe_control_action-${context.id}" disabled>${context.unsafe_control_action}</textarea>

                        ${hazards_tags}
                        <br/>
                        <br/>
                    </div>
                    
                    <div class="text">
                        <br/>
                        <textarea class="uca_list_textarea" id="safety_constraint-${context.id}" disabled>${context.safety_constraint}</textarea>
                    </div>
                    
                    <div class="content-uca">
                        <form class="edit-form" data-edit="uca" method="POST" style="display: inline-block; float: left;">
                            <input type="hidden" name="_token" value="${token}">
                            <input type="hidden" name="controlaction_id" id="controlaction_id" value="${context.controlaction_id}">
                            <input type="hidden" name="safety_constraint_id" id="safety_constraint_id" value="${context.id}">
                            <input type="image" src="/images/edit.ico" alt="Delete" width="20" class="navbar__logo">
                        </form>
                        <form action="/deleteuca" class="delete-form" data-delete="uca" method="POST" style="display: inline-block; float: left;">
                            <input type="hidden" name="_token" value="${token}">
                            <input type="hidden" name="controlaction_id" id="controlaction_id" value="${context.controlaction_id}">
                            <input type="hidden" name="safety_constraint_id" id="safety_constraint_id" value="${context.id}">
                            <input type="image" src="/images/trash.png" alt="Delete" width="20" class="navbar__logo">
                        </form>
                    </div>
        </div>`;
};
