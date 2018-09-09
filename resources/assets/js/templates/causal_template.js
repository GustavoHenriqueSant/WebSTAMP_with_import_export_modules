module.exports = function(context) {

var select = `<select id="guideword-${context.id}" class="guideword-combo" disabled>`;
     if(context.guideword == 1) 
        select += `<option value="1" title="Control input or external information wrong or missing" selected>[Control input or external information wrong or missing]</option>`;
     else
        select += `<option value="1" title="Control input or external information wrong or missing">[Control input or external information wrong or missing]</option>`;
    
    if(context.guideword == 2) 
        select += `<option value="2" title="Inadequate Control Algorithm" selected>[Inadequate Control Algorithm]</option>`;
    else
        select += `<option value="2" title="Inadequate Control Algorithm">[Inadequate Control Algorithm]</option>`;
    
    if(context.guideword == 3) 
        select += `<option value="3" title="Process Model inconsistent, incorrect or incomplete" selected>[Process Model inconsistent, incorrect or incomplete]</option>`;
    else
        select += `<option value="3" title="Process Model inconsistent, incorrect or incomplete">[Process Model inconsistent, incorrect or incomplete]</option>`;
    
    if(context.guideword == 4) 
        select += `<option value="4" title="Inappropriate, ineffective or missing control action" selected>[Inappropriate, ineffective or missing control action]</option>`;
    else
        select += `<option value="4" title="Inappropriate, ineffective or missing control action">[Inappropriate, ineffective or missing control action]</option>`;
     
    if(context.guideword == 5) 
        select += `<option value="5" title="Inadequate Operation" selected>[Inadequate Operation]</option>`;
    else
        select += `<option value="5" title="Inadequate Operation">[Inadequate Operation]</option>`;
    
    if(context.guideword == 6) 
        select += `<option value="6" title="Delayed Operation" selected>[Delayed Operation]</option>`;
    else
        select += `<option value="6" title="Delayed Operation">[Delayed Operation]</option>`;
    
    if(context.guideword == 7) 
        select += `<option value="7" title="Conflicting Control Actions" selected>[Conflicting Control Actions]</option>`;
    else
        select += `<option value="7" title="Conflicting Control Actions">[Conflicting Control Actions]</option>`;
    
    if(context.guideword == 8) 
        select += `<option value="8" title="Component Failures" selected>[Component Failures]</option>`;
    else
        select += `<option value="8" title="Component Failures">[Component Failures]</option>`;
    
    if(context.guideword == 9) 
        select += `<option value="9" title="Changes over time" selected>[Changes over time]</option>`;
    else
        select += `<option value="9" title="Changes over time">[Changes over time]</option>`;
    
    if(context.guideword == 10) 
        select += `<option value="10" title="Process Input missing or wrong" selected>[Process Input missing or wrong]</option>`;
    else
        select += `<option value="10" title="Process Input missing or wrong">[Process Input missing or wrong]</option>`;
     
    if(context.guideword == 11) 
        select += `<option value="11" title="Unidentified or out-of-range disturbance" selected>[Unidentified or out-of-range disturbance]</option>`;
    else
        select += `<option value="11" title="Unidentified or out-of-range disturbance">[Unidentified or out-of-range disturbance]</option>`;
     
    if(context.guideword == 12) 
        select += `<option value="12" title="Process output contributes to hazard" selected>[Process output contributes to hazard]</option>`;
    else
        select += `<option value="12" title="Process output contributes to hazard">[Process output contributes to hazard]</option>`;
     
    if(context.guideword == 13) 
        select += `<option value="13" title="Feedback delays" selected>[Feedback delays]</option>`;
    else
        select += `<option value="13" title="Feedback delays">[Feedback delays]</option>`;
     
    if(context.guideword == 14) 
        select += `<option value="14" title="Measurement inaccuracies" selected>[Measurement inaccuracies]</option>`;
    else
        select += `<option value="14" title="Measurement inaccuracies">[Measurement inaccuracies]</option>`;
     
    if(context.guideword == 15) 
        select += `<option value="15" title="Incorrect or no information provided" selected>[Incorrect or no information provided]</option>`;
    else
        select += `<option value="15" title="Incorrect or no information provided">[Incorrect or no information provided]</option>`;
     
    if(context.guideword == 16) 
        select += `<option value="16" title="Inadequate Operation" selected>[Inadequate Operation]</option>`;
    else
        select += `<option value="16" title="Inadequate Operation">[Inadequate Operation]</option>`;
     
    if(context.guideword == 17) 
        select += `<option value="17" title="Feedback Delays" selected>[Feedback Delays]</option>`;
    else
        select += `<option value="17" title="Feedback Delays">[Feedback Delays]</option>`;
     
    if(context.guideword == 18) 
        select += `<option value="18" title="Inadequate or missing feedback" selected>[Inadequate or missing feedback]</option>`;
     else
        select += `<option value="18" title="Inadequate or missing feedback">[Inadequate or missing feedback]</option>`;

select += `</select>`; 

return `<div class="table-row" id="causal-row-${context.id}"">
            <div class="text">
                ${select}<br/>
            <textarea class="step2_textarea" name="scenario-${context.id}" id="scenario-${context.id}" placeholder="Scenario" disabled>${context.scenario}</textarea>
            </div>

    <div class="text center"><br/><textarea class="step2_textarea" id="associated-${context.id}" placeholder="Associated Causal Factors" disabled>${context.associated}</textarea></div>
    <div class="text center"><br/><textarea class="step2_textarea" id="requirement-${context.id}" placeholder="Requirements" disabled>${context.requirement}</textarea></div>
    <div class="text center"><br/><textarea class="step2_textarea" id="rationale-${context.id}" placeholder="Rationales" disabled>${context.rationale}</textarea></div>
    <div class="content-uca">
            <br/>
            <form action="/edittuple" class="edit-form" data-edit="uca" method="POST" style="display: inline-block; float: left;">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <input type="hidden" name="causal_id" id="causal_id" value="${context.id}">
                <input type="image" src="/images/edit.ico" alt="Delete" width="20" class="navbar__logo">
            </form>
            <form action="/deletetuple" class="delete-form" data-delete="uca" method="POST" style="display: inline-block; float: left;">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <input type="hidden" name="causal_id" id="causal_id" value="${context.id}">
                <input type="image" src="/images/trash.png" alt="Delete" width="20" class="navbar__logo">
            </form>
    </div>
</div>`;
}