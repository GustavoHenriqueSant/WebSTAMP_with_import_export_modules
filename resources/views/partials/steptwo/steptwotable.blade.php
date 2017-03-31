<div class="substep__title">
    {{$ca->name}}
</div>

<div class="substep__content">

    @foreach(App\SafetyConstraints::where('controlaction_id', $ca->id)->get() as $safety_constraint)
        <div class="center unsafe_control_action">
            <b>Unsafe Control Action</b>: {{$safety_constraint->unsafe_control_action}}
        </div>
        <div class="center">
            <?php
                $operator = strtolower($ca->controller->name);

                $type = strtolower($safety_constraint->type);

                $ca->name = strtolower($ca->name);

                $context = array_pad(explode("when ", $safety_constraint->unsafe_control_action, 2), 2, null)[1];
                //$context = $context[1];
            ?>
            <b>Guide Question</b>: What are the causal factors that make the <b>{{$ca->name}}</b> to be <b>{{$type}}</b> by the <b>{{$operator}}</b> when <b>{{$context}}</b>
        </div>

        <div class="container" id="safety-{{$safety_constraint->id}}">

            <div class="container-fluid">

            <div class="table-content">

                <div class="table-row header">
                    <div class="text center">Scenarios</div>
                    <div class="text center">Associated Causal Factors</div>
                    <div class="text center">Requirements</div>
                    <div class="text center">Allocated to</div>
                    <div class="text center">Rationales</div>
                    <div class="text center">
                        <form action="/edituca" class="edit-form" data-edit="uca" method="POST">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <input type="hidden" name="controlaction_id" id="controlaction_id" value="1">
                            <input type="hidden" name="safety_constraint_id" id="safety_constraint_id" value="1">
                            <input type="image" src="{{ asset('images/plus.png') }}" alt="Delete" width="20" class="navbar__logo"> Add new line
                        </form>
                    </div>
                </div>

                    @foreach(App\CausalAnalysis::where('safety_constraint_id', $safety_constraint->id)->get() as $causal)
                    <div class="table-row" id="causal-row-{{$causal->id}}">
                        <div class="text center">
                            <select id="guideword-{{$causal->id}}" class="guideword-combo" disabled>
                                <option disabled>[GUIDEWORD]</option> 
                                @foreach(App\Guidewords::all() as $guideword)
                                <?php
                                    if ($causal->guideword_id == $guideword->id)
                                        $selected = "selected";
                                    else
                                        $selected = "";
                                ?>
                                    <option value="{{$guideword->id}}" title="{{$guideword->guideword}}" {{$selected}}>[{{$guideword->guideword}}]</option>
                                @endforeach
                            </select><br/>
                            
                            <textarea class="step2_textarea" name="scenario-{{$causal->id}}" id="scenario-{{$causal->id}}" placeholder="Scenario" disabled>{{$causal->scenario}}</textarea>
                        </div>

                        <div class="text center"><br/><textarea class="step2_textarea" id="associated-{{$causal->id}}" placeholder="Associated Causal Factors" disabled>{{$causal->associated_causal_factor}}</textarea></div>
                        <div class="text center"><br/><textarea class="step2_textarea" id="requirement-{{$causal->id}}" placeholder="Requirements" disabled>{{$causal->requirement}}</textarea></div>
                        <div class="text center"><br/><textarea class="step2_textarea" id="role-{{$causal->id}}" placeholder="Role" disabled>{{$causal->role}}</textarea></div>
                        <div class="text center"><br/><textarea class="step2_textarea" id="rationale-{{$causal->id}}" placeholder="Rationales" disabled>{{$causal->rationale}}</textarea></div>
                        <div class="text center">
                            <div style="display: inline-block;">
                                <br/>
                                <form action="/edittuple" class="edit-form" data-edit="uca" method="POST" style="display: inline-block; float: left;">
                                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                                    <input type="hidden" name="causal_id" id="causal_id" value="{{$causal->id}}">
                                    <input type="image" src="{{ asset('images/edit.ico') }}" alt="Delete" width="20" class="navbar__logo">
                                </form>
                                <form action="/deletetuple" class="delete-form" data-delete="uca" method="POST" style="display: inline-block; float: left;">
                                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                                    <input type="hidden" name="causal_id" id="causal_id" value="{{$causal->id}}">
                                    <input type="image" src="{{ asset('images/trash.png') }}" alt="Delete" width="20" class="navbar__logo">
                                </form>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    </div>

                    <div class="table-row">
                        <div class="text center"></div>
                        <div class="text center">
                            <form action="/" class="teste-vex" method="POST" data-id="{{$safety_constraint->id}}" style="display: inline-block;" >
                                <button>Import Data</button>
                            </form>
                            <form action="/testeUCA" class="test-vex" method="POST" data-id="{{$safety_constraint->id}}" style="display: inline-block;" >
                                <button>Add New Scenario</button></div>
                                <input type="hidden" id="tst" name="tst" value="{{$safety_constraint->id}}">
                            </form>
                        <div class="text center"></div>
                    </div>

                    <!--
                    <div class="table-row">
                        <div class="text center">
                            <div data-component="add-button" data-add="guideword">
                                <input type="image" src="{{ asset('images/plus.png') }}" alt="Edit" width="20" class="navbar__logo">
                            </div>
                        </div>
                        <div class="text center">Associated Causal Factors</div>
                        <div class="text center">Requirements</div>
                        <div class="text center">Allocated to</div>
                        <div class="text center">Rationales</div>
                    </div>-->

            </div>     

        </div>
        <br/><br/><br/>
    @endforeach
</div>