<div class="substep__title">
    Create new Hazardous Control Action - {{$ca->name}}&nbsp<i class="fa fa-question-circle" title="An Unsafe or Hazardous Control Action (UCA or HCA) is a control action that, in a particular context and worst-case environment, will lead to a hazard. (Adapted from STPA Handbook, p. 35)"></i>
</div>

<?php
    $variables = App\Variable::where('project_id', $project_id)->whereIn('controller_id', [0, $controller->id])->get();
?>
<div class="substep__content">

    <div class="container-fluid" style="margin-top: 10px">
        <div id="add-new-uca-{{$ca->id}}" >
            <form action="/addnewuca" class="adding-manual-uca" method="POST">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <input type="hidden" name="controlaction_id" id="controlaction_id" value="{{$ca->id}}">
                <input type="hidden" name="controller_name" id="controller_name" value="{{$controller->name}}">
                <input type="hidden" name="controlaction_name" id="controlaction_name" value="{{$ca->name}}">
                <input type="hidden" name="context" id="context" value="0">
                
                    <div class="table-row header">
                        <div class="text">Defining the context of potentially hazardous control action</div>
                    </div>
                    <div class="table-row header">
                        <div class="text">Type</div>
                        @foreach($variables as $variable)
                            <div class="text">{{$variable->name}}</div>
                        @endforeach
                        <div class="text">Associated Hazards</div>
                    </div>
                    <div class="table-row center">
                        <select id="type-uca-{{$ca->id}}" class="text type-uca add-uca-change" required>
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
                            <select class="text uca-row-{{$ca->id}} add-uca-change">
                                <option></option>
                            @foreach(App\State::where('variable_id', $variable->id)->get() as $state)
                                <option value="{{$state->id}}-{{$variable->name}}">{{$state->name}}</option>
                            @endforeach
                            </select>
                        @endforeach

                        <select id="hazard_column" name="hazard_column" class="select_from_form_rule" multiple required title="">
                            @foreach(App\Hazards::where('project_id', $project_id)->orderBy('id', 'asc')->get() as $hazard)

                                <option class="option_text" value="{{$hazard->id}}" name="[H-{{$hazard_map[$hazard->id]}}]:{{$hazard->name}}"> [H-{{$hazard_map[$hazard->id]}}] {{$hazard->name}}</option>
                                
                            @endforeach
                        </select>

                    </div>
                    <div class="table-row">
                        <div class="text unsafe-control" id="unsafe-text-{{$ca->id}}"></div>
                        <div class="text safety-control" id="safety-text-{{$ca->id}}"></div>
                        <!--
                        <div>
                        <form action="/edituca" class="edit-form" data-edit="uca" method="POST">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <input type="image" src="{{ asset('images/edit.ico') }}" alt="Delete" width="20" class="navbar__logo">
                        </form>
                        </div> 
                        <div>
                            <form action="/deleteuca" class="delete-form" data-delete="uca" method="POST">
                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                <input type="image" src="{{ asset('images/trash.png') }}" alt="Delete" width="20" class="navbar__logo">
                            </form>
                        </div>
                        -->
                    </div>
                
                    
                </br>

                <center> <button class="font-button"><img src="/images/plus.png" class="steptwo-button" width="15"/> Add new hazardous control action </button> </center>

                </br>

            </form>
        </div>

    </div>
</div>
