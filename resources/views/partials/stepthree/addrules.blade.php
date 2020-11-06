    <div class="substep__title">
    Add new rule to hazardous control action - {{$ca->name}}
</div>

<div class="substep__content">

    @if (App\Variable::where('project_id', $project_id)->whereIn('controller_id', [0, $controller->id])->count() > 0)
        <div class="container-fluid" style="margin-top: 10px">

            <form action="/addrule" id="addrule" method="POST" class="add-new-rule">
                <div class="addrule-table">
                    <div class="table-row header">
                        <div class="text"> Apply the Rule to the columns</div>
                        @foreach (App\Variable::where('project_id', $project_id)->whereIn('controller_id', [0, $controller->id])->orderBy('id', 'asc')->get() as $variable)
                            @if ($variable->name != "Default")
                            <div class="text"> {{$variable->name}}</div>
                            @endif
                        @endforeach
                        <div class="text">Associated Hazards</div>
                    </div>

                    
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <input type="hidden" id="controlaction_id" name="controlaction_id" value="{{$ca->id}}">
                    
                    <div class="table-row">
                        <div class="text">
                            <select id="rule_column" name="rule_column" class="select_from_form_rule" multiple required title="">
                                <option class="option_text" value="Provided" selected="true">Provided</option>
                                <option class="option_text" value="Not Provided">Not Provided</option>
                                <option class="option_text"value="Provided too early">Provided too early</option>
                                <option class="option_text" value="Provided too late">Provided too late</option>
                                <option class="option_text" value="Wrong order">Provided in wrong order</option>
                                <option class="option_text" value="Stopped too soon">Stopped too soon</option>
                                <option class="option_text" value="Applied too long">Applied too long</option>
                            </select>
                        </div>
                        @foreach (App\Variable::where('project_id', $project_id)->whereIn('controller_id', [0, $controller->id])->orderBy('id', 'asc')->get() as $variable)
                            <div class="text">
                                <select id="variable_id_{{$variable->id}}" name="variable_id_{{$variable->id}}" class="select_from_form_rule">
                                    <option value="{{$variable->id}}-0" name="ANY">ANY</option>
                                    @foreach (App\State::where('variable_id', $variable->id)->get() as $state)
                                        <option value="{{$variable->id}}-{{$state->id}}" name="{{$state->name}}">{{$state->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        @endforeach
                        <div class="text">
                            <select id="hazard_column" name="hazard_column" class="select_from_form_rule" multiple required title="">
                                @foreach(App\Hazards::where('project_id', $project_id)->orderBy('id', 'asc')->get() as $hazard)
                                    <option class="option_text" value="{{$hazard->id}}" > [H-{{$hazard_map[$hazard->id]}}] {{$hazard->name}}</option>
                                    
                                @endforeach
                            </select>
                        </div>
                    </div>
                        
                        <input type="hidden" name="uca-associated-{{$ca->id}}" id="uca-associated-{{$ca->id}}" value="{{$ca->controller->name}} provides {{$ca->name}} when"/>
                </div>

                </br><center><button class="font-button"><img src="/images/plus.png" class="steptwo-button" width="15"/> Add new rule</button></center>
            </form>
        </div>
    @endif
    
</div>