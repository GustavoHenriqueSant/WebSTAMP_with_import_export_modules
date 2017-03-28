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
                $operator = $ca->controller->name;

                if (strpos($safety_constraint->unsafe_control_action, 'not provide') !== false){
                    $type = 'not provided';
                } else {
                    $type = 'provided';
                }

                $ca->name = strtolower($ca->name);
                $operator = strtolower($operator);

                $context = array_pad(explode("when ", $safety_constraint->unsafe_control_action, 2), 2, null);
                $context = $context[1];
            ?>
            <b>Guide Question</b>: What are the causal factors that make the <b>{{$ca->name}}</b> to be <b>{{$type}}</b> by the <b>{{$operator}}</b> when <b>{{$context}}</b>
        </div>

        <div class="container">

            <div class="container-fluid" style="margin-top: 10px">

                <div class="table-row header">
                    <div class="text center">Scenarios</div>
                    <div class="text center">Associated Causal Factors</div>
                    <div class="text center">Requirements</div>
                    <div class="text center">Allocated to</div>
                    <div class="text center">Rationales</div>
                </div>

                    <div class="table-row">
                        <div class="text center">
                            <select id="guideword" style="-webkit-appearance: none; box-shadow: none !important; border: 0;">
                                <option disabled selected>[GUIDEWORD]</option> 
                                <option disabled style="background: black; color: white;" style="background: black; color: white;">External ↔ Controller</option>
                                    <option>[Control input or external information wrong or missing]</option>
                                <option disabled style="background: black; color: white;">Controller</option>
                                    <option>[Inadequate Control Algorithm]</option>
                                    <option>[Process Model inconsistent, incorrect or incomplete]</option>
                                <option disabled style="background: black; color: white;">Controller ↔ Actuator</option>
                                    <option>[Inappropriate, ineffective or missing control action]</option>
                                <option disabled style="background: black; color: white;">Actuator</option>
                                    <option>[Inadequate Operation]</option>
                                <option disabled style="background: black; color: white;">Actuator ↔ Controlled Process</option>
                                    <option>[Delayed Operation]</option>
                                <option disabled style="background: black; color: white;">Controller 2 ↔ Controlled Process</option>
                                    <option>[Conflicting Control Actions]</option>
                                <option disabled style="background: black; color: white;">Controlled Process</option>
                                    <option>[Component Failures]</option>
                                    <option>[Changes over time]</option>
                                <option disabled style="background: black; color: white;">External ↔ Controlled Process</option>
                                    <option>[Process Input missing or wrong]</option>
                                    <option>[Unidentified or out-of-range disturbance]</option>
                                <option disabled style="background: black; color: white;">Controlled Process ↔ External</option>
                                    <option>Process output contributes to hazard]</option>
                                <option disabled style="background: black; color: white;">Controlled Process ↔ Sensor</option>
                                    <option>[Feedback delays]</option>
                                    <option>[Measurement inaccuracies]</option>
                                    <option>[Incorrect or no information provided]</option>
                                <option disabled style="background: black; color: white;">Sensor</option>
                                    <option>[Inadequate Operation]</option>
                                <option disabled style="background: black; color: white;">Sensor ↔ Controller</option>
                                    <option>[Feedback Delays]</option>
                                    <option>[Inadequate or missing feedback]</option>
                            </select><br/>
                            
                            <textarea style="-webkit-appearance: none; box-shadow: none !important; border: 0;width: 100%;" placeholder="Scenario"></textarea>
                        </div>

                        <div class="text center"><textarea style="-webkit-appearance: none; box-shadow: none !important; border: 0;width: 100%;" placeholder="Associated Causal Factors"></textarea></div>
                        <div class="text center"><textarea style="-webkit-appearance: none; box-shadow: none !important; border: 0;width: 100%;" placeholder="Requirements"></textarea></div>
                        <div class="text center"><textarea style="-webkit-appearance: none; box-shadow: none !important; border: 0;width: 100%;" placeholder="Role"></textarea></div>
                        <div class="text center"><textarea style="-webkit-appearance: none; box-shadow: none !important; border: 0;width: 100%;" placeholder="Rationales"></textarea></div>
                    </div>
                    <div class="table-row">
                        <div class="text center">
                            <div data-component="add-button" data-add="guideword-{{$safety_constraint->id}}">
                                <input type="image" src="{{ asset('images/plus.png') }}" alt="Edit" width="20" class="navbar__logo">
                            </div>
                        </div>
                        <div class="text center"><button class="teste-vex">Botão</button></div>
                        <div class="text center"></div>
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