<?php
    $variables = App\Variable::where('project_id', 1)->where('controller_id', 0)->orWhere('controller_id', $controller->id)->get();
?>
<div id="add-suggested-uca-{{$ca->id}}" style="display: none;">
    <form action="/addnewuca" class="adding-uca" method="POST">
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <input type="hidden" name="controlaction_id" id="controlaction_id" value="{{$ca->id}}">
        <input type="hidden" name="controller_name" id="controller_name" value="{{$controller->name}}">
        <input type="hidden" name="controlaction_name" id="controlaction_name" value="{{$ca->name}}">
        <div class="vex-dialog-form">
            <div class="container">
                <div class="container-fluid">
                    <div class="table-row header">
                        <div class="text">Suggested Hazardous Control Actions</div>
                        <div class="text">Suggested Associated Safety & Security Constraints</div>
                        <div class="content-uca">Include?</div>
                    </div>
                    <div id="suggested-content-{{$ca->id}}">
                    </div>
                </div>
                
                
                <div class="vex-dialog-input"></div>
                <div class="vex-dialog-buttons">
                    <div style="display: table; margin: 0 auto;">
                        <button class="vex-dialog-button-primary vex-dialog-button vex-first">Add</button>
                        <!--<button class="vex-dialog-button-secondary vex-dialog-button vex-last">Cancel</button>-->
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
