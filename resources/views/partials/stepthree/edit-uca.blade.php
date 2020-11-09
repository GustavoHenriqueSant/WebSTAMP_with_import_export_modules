    <?php
    $variables = App\Variable::where('project_id', $project_id)->whereIn('controller_id', [0, $controller->id])->get();
?>
<div class="edit-uca-{{$ca->id}}" style="display: none;">
    <form action="/edituca" class="edit-manual-uca" method="POST">
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <input type="hidden" name="sc_flag" id="sc_flag" value="">
        <input type="hidden" name="controlaction_id" id="controlaction_id" value="{{$ca->id}}">
        <input type="hidden" name="controller_name" id="controller_name" value="{{$controller->name}}">
        <input type="hidden" name="controlaction_name" id="controlaction_name" value="{{$ca->name}}">
        <input type="hidden" name="context" id="context" value="0">
        <input type="hidden" name="id_sc_ca_{{$ca->id}}" id="id_sc_ca_{{$ca->id}}" value="0">
        <div class="vex-dialog-form">
            <div class="container">
                <div class="container-fluid">
                    <div class="table-row header">
                        <div class="text">Edit the Hazardous Control Action</div>
                    </div>
                    <div class="table-row header">
                        <div class="text">Type</div>
                        @foreach($variables as $variable)
                            <div class="text">{{$variable->name}}</div>
                        @endforeach
                        <div class="text">Associated Hazards</div>
                    </div>
                    <div class="table-row center">
                        <select id="edit_type-uca-{{$ca->id}}" class="text edit_type-uca edit-uca-change" required="">
                                <option></option>
                                <option value="Provided">Provided</option>
                                <option value="Not Provided">Not Provided</option>
                                <option value="Wrong Time">Provided in wrong time</option>
                                <option value="Wrong Order">Provided in wrong order</option>
                                <option value="Provided too early">Provided too early</option>
                                <option value="Provided too late">Provided too late</option>
                                <option value="Stopped too soon">Stopped too soon</option>
                                <option value="Applied too long">Applied too long</option>
                        </select>
                        @foreach($variables as $variable)
                            <select class="text uca-edit-row-{{$ca->id}} edit-uca-change">
                                <option></option>
                            @foreach(App\State::where('variable_id', $variable->id)->get() as $state)
                                <option value="{{$state->id}}-{{$variable->name}}">{{$state->name}}</option>
                            @endforeach
                            </select>
                        @endforeach

                        <select name="hazard_column" class="select_from_form_rule hazard_column_edit_uca" multiple required title="">
                            @foreach(App\Hazards::where('project_id', $project_id)->orderBy('id', 'asc')->get() as $hazard)

                                <option class="option_text" value="{{$hazard->id}}" name="[H-{{$hazard_map[$hazard->id]}}]:{{$hazard->name}}"> [H-{{$hazard_map[$hazard->id]}}] {{$hazard->name}}</option>
                                
                            @endforeach
                        </select>
                    </div>
                    <div class="table-row">
                        <div class="text edit-unsafe-control">
                            <br/>
                            <center><b class="uca-edition-text">Current hazardous control action:</b></center>
                            <textarea  class='uca_list_textarea edit-unsafe-text'></textarea>
                        </div>
                        &nbsp
                        <div class="text edit-safety-control">
                            <br/>
                            <center><b class="sc-edition-text">Associated safety & security constraint:</b></center>
                            <textarea class='uca_list_textarea edit-safety-text'></textarea>
                        </div>
                    </div>
                </div>
            </div>
            
            
            <div class="vex-dialog-input"></div>
            <div class="vex-dialog-buttons">
                <div style="display: table; margin: 0 auto;">
                    <button class="vex-dialog-button-primary vex-dialog-button vex-first">Save</button>
                </div>
            </div>
        </div>
    </form>
</div>