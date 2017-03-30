<div class="substep__title">
    {{$ca->name}}
</div>

<div class="substep__content">

    @foreach(App\SafetyConstraints::where('controlaction_id', $ca->id)->get() as $safety_constraint)
        <div class="center unsafe_control_action" id="guideword-{{$safety_constraint->id}}">
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

        <div class="container">

            <div class="container-fluid">

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

                    <div class="table-row">
                        <div class="text center">
                            <select id="guideword" class="guideword-combo">
                                <option disabled selected>[GUIDEWORD]</option> 
                                <option class="guideword-option" disabled class="guideword-option">External ↔ Controller</option>
                                    <option>[Control input or external information wrong or missing]</option>
                                <option class="guideword-option" disabled>Controller</option>
                                    <option>[Inadequate Control Algorithm]</option>
                                    <option>[Process Model inconsistent, incorrect or incomplete]</option>
                                <option class="guideword-option" disabled>Controller ↔ Actuator</option>
                                    <option>[Inappropriate, ineffective or missing control action]</option>
                                <option class="guideword-option" disabled>Actuator</option>
                                    <option>[Inadequate Operation]</option>
                                <option class="guideword-option" disabled>Actuator ↔ Controlled Process</option>
                                    <option>[Delayed Operation]</option>
                                <option class="guideword-option" disabled>Controller 2 ↔ Controlled Process</option>
                                    <option>[Conflicting Control Actions]</option>
                                <option class="guideword-option" disabled>Controlled Process</option>
                                    <option>[Component Failures]</option>
                                    <option>[Changes over time]</option>
                                <option class="guideword-option" disabled>External ↔ Controlled Process</option>
                                    <option>[Process Input missing or wrong]</option>
                                    <option>[Unidentified or out-of-range disturbance]</option>
                                <option class="guideword-option" disabled>Controlled Process ↔ External</option>
                                    <option>Process output contributes to hazard]</option>
                                <option disabled style="">Controlled Process ↔ Sensor</option>
                                    <option>[Feedback delays]</option>
                                    <option>[Measurement inaccuracies]</option>
                                    <option>[Incorrect or no information provided]</option>
                                <option class="guideword-option" disabled>Sensor</option>
                                    <option>[Inadequate Operation]</option>
                                <option class="guideword-option" disabled>Sensor ↔ Controller</option>
                                    <option>[Feedback Delays]</option>
                                    <option>[Inadequate or missing feedback]</option>
                            </select><br/>
                            
                            <textarea class="step2_textarea" placeholder="Scenario"></textarea>
                        </div>

                        <div class="text center"><textarea class="step2_textarea" placeholder="Associated Causal Factors"></textarea></div>
                        <div class="text center"><textarea class="step2_textarea" placeholder="Requirements"></textarea></div>
                        <div class="text center"><textarea class="step2_textarea" placeholder="Role"></textarea></div>
                        <div class="text center"><textarea class="step2_textarea" placeholder="Rationales"></textarea></div>
                        <div class="text center">
                            <div style="display: inline-block;">
                                <form action="/edituca" class="edit-form" data-edit="uca" method="POST" style="display: inline-block; float: left;">
                                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                                    <input type="hidden" name="controlaction_id" id="controlaction_id" value="1">
                                    <input type="hidden" name="safety_constraint_id" id="safety_constraint_id" value="1">
                                    <input type="image" src="{{ asset('images/edit.ico') }}" alt="Delete" width="20" class="navbar__logo">
                                </form>
                                <form action="/deleteuca" class="delete-form" data-delete="uca" method="POST" style="display: inline-block; float: left;">
                                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                                    <input type="hidden" name="controlaction_id" id="controlaction_id" value="1">
                                    <input type="hidden" name="safety_constraint_id" id="safety_constraint_id" value="1">
                                    <input type="image" src="{{ asset('images/trash.png') }}" alt="Delete" width="20" class="navbar__logo">
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="table-row">
                        <div class="text center">
                            <div data-component="add-button" data-add="guideword-{{$safety_constraint->id}}">
                                <input type="image" src="{{ asset('images/plus.png') }}" alt="Edit" width="20" class="navbar__logo">
                            </div>
                        </div>
                        <div class="text center"></div>
                        <div class="text center"><button class="teste-vex">Botão</button><button class="test-vex">Botão 1</button></div>
                        <div class="text center"></div>
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