<?php
    $variables = App\Variable::where('project_id', $project_id)->whereIn('controller_id', [0, $controller->id])->get();
?>
<div id="add-new-uca-{{$ca->id}}" style="display: none;">
    <form action="/addnewuca" class="adding-uca" method="POST">
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <input type="hidden" name="controlaction_id" id="controlaction_id" value="{{$ca->id}}">
        <input type="hidden" name="controller_name" id="controller_name" value="{{$controller->name}}">
        <input type="hidden" name="controlaction_name" id="controlaction_name" value="{{$ca->name}}">
        <div class="vex-dialog-form">
            <div class="container">
                <div class="container-fluid">
                    <div class="table-row header">
                        <div class="text">Defining the context of potentially unsafe control action</div>
                    </div>
                    <div class="table-row header">
                        <div class="text">Type</div>
                        @foreach($variables as $variable)
                            <div class="text">{{$variable->name}}</div>
                        @endforeach
                    </div>
                    <div class="table-row center">
                        <select id="type-uca-{{$ca->id}}" class="text type-uca mudanca">
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
                            <select class="text uca-row-{{$ca->id}} mudanca">
                                <option></option>
                            @foreach(App\State::where('variable_id', $variable->id)->get() as $state)
                                <option value="{{$state->id}}-{{$variable->name}}">{{$state->name}}</option>
                            @endforeach
                            </select>
                        @endforeach
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
    </form>
</div>
