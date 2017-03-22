<div class="substep__title">
    {{$ca->name}}
</div>

<div class="substep__content">

    @foreach(App\SafetyConstraints::where('controlaction_id', $ca->id)->get() as $safety_constraint)
        <center>
        <div>
            <b>Unsafe Control Action</b>: {{$safety_constraint->unsafe_control_action}}
        </div>
        <div>
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
        </center>

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
                            <div data-component="add-button" data-add="guideword">
                                <input type="image" src="{{ asset('images/plus.png') }}" alt="Edit" width="20" class="navbar__logo">
                            </div>
                        </div>
                        <div class="text center">Associated Causal Factors</div>
                        <div class="text center">Requirements</div>
                        <div class="text center">Allocated to</div>
                        <div class="text center">Rationales</div>
                    </div>

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
                    </div>

            </div>     

        </div>
        <br/><br/><br/>
    @endforeach
</div>