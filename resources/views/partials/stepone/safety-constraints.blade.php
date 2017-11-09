<div class="substep__title">
    Unsafe Control Actions and Associated Safety Constraints - {{$ca->name}}
</div>

<div class="substep__add add-new-uca" id="ca-{{$ca->id}}">
    +
</div>

<div class="substep__content add-uca" id="uca-{{$ca->id}}">

    <div class="container">

        <div class="container-fluid" style="margin-top: 10px">
            <!--
            <form action="/generateUCA" method="POST">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <input type="hidden" name="controlaction_id" id="controlaction_id" value="{{$ca->id}}">
                <input type="submit"/>
            </form>

            <form action="/addnewuca" method="POST" class="add-new-uca">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <input type="hidden" name="controlaction_id" id="controlaction_id" value="{{$ca->id}}">
                <input type="submit"/>
            </form>
            -->
            <div class="table-row header">
                <div class="text">Unsafe Control Actions</div>
                <div class="text">Associated Safety Constraint</div>
                <div class="number-contexttable"><!-- Edit/Delete icons --></div>
            </div>

            <!--
            @foreach (App\Rules::where('controlaction_id', $ca->id)->select('index')->distinct()->get() as $rule_index)
            <?php

            $iterations = count(App\Rules::where('index', $rule_index->index)->where('controlaction_id', $ca->id)->where('state_id', '>', 0)->get());
            $actual_index = -1;

            ?>
            <div class="table-row">
                <div class="text">
                    {{$ca->controller->name}}<b> provides</b> {{$ca->name}} <b>when</b>
                    @foreach (App\Rules::where('index', $rule_index->index)->where('controlaction_id', $ca->id)->where('state_id', '>', 0)->get() as $rule)
                        @if($iterations == 0)
                            {{App\State::find($rule->state_id)->name}}
                        @elseif ($actual_index++ < $iterations-2)
                            {{App\State::find($rule->state_id)->name}} and
                        @else
                            {{App\State::find($rule->state_id)->name}}.
                        @endif
                    @endforeach
                </div>
                <div class="text">
                </div>
            </div>
            @endforeach 
            -->

            @foreach(App\SafetyConstraints::where('controlaction_id', $ca->id)->get() as $sc)
                <div class="table-row" id="uca-row-{{$sc->id}}">
                    
                    <div class="text">
                        <br/>
                        <textarea class="uca_list_textarea" id="unsafe_control_action-{{$sc->id}}" disabled>{{$sc->unsafe_control_action}}</textarea>
                    </div>
                    
                    <div class="text">
                        <select id="type-{{$sc->id}}" class="type-combo" style="-webkit-appearance: none; box-shadow: none !important; border: 0;" disabled>
                            @if($sc->type == "Provided" || $sc->type == "provided")
                                <option value="Provided" selected>[Provided]</option>
                            @else
                                <option value="Provided">[Provided]</option>
                            @endif

                            @if($sc->type == "Not Provided" || $sc->type == "Not provided")
                                <option value="Not Provided" selected>[Not Provided]</option>
                            @else
                                <option value="Not Provided">[Not Provided]</option>
                            @endif

                            @if($sc->type == "Wrong Time" || $sc->type == "Provided in wrong time")
                                <option value="Wrong Time" selected>[Wrong time]</option>
                            @else
                                <option value="Wrong Time">[Wrong time]</option>
                            @endif

                            @if($sc->type == "Wrong Order" || $sc->type == "Provided in wrong order")
                                <option value="Wrong Order" selected>[Wrong order]</option>
                            @else
                                <option value="Wrong Order">[Wrong order]</option>
                            @endif

                            @if($sc->type == "Provided too early" || $sc->type == "Provided too early")
                                <option value="Provided too early" selected>[Provided too early]</option>
                            @else
                                <option value="Provided too early">[Provided too early]</option>
                            @endif

                            @if($sc->type == "Provided too late" || $sc->type == "Provided too late")
                                <option value="Provided too late" selected>[Provided too late]</option>
                            @else
                                <option value="Provided too late">[Provided too late]</option>
                            @endif

                            @if($sc->type == "Stopped too soon" || $sc->type == "Stopped too soon")
                                <option value="Stopped too soon" selected>[Stopped too soon]</option>
                            @else
                                <option value="Stopped too soon">[Stopped too soon]</option>
                            @endif

                            @if($sc->type == "Applied too long" || $sc->type == "Applied too long")
                                <option value="Applied too long" selected>[Applied too long]</option>
                            @else
                                <option value="Applied too long">[Applied too long]</option>
                            @endif
                        </select>

                        <textarea class="uca_list_textarea" id="safety_constraint-{{$sc->id}}" disabled>{{$sc->safety_constraint}}</textarea>
                    </div>
                    
                    <div class="content-uca">
                        <form action="/edituca" class="edit-form" data-edit="uca" method="POST" style="display: inline-block; float: left;">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <input type="hidden" name="controlaction_id" id="controlaction_id" value="{{$ca->id}}">
                            <input type="hidden" name="safety_constraint_id" id="safety_constraint_id" value="{{$sc->id}}">
                            <input type="image" src="{{ asset('images/edit.ico') }}" alt="Delete" width="20" class="navbar__logo">
                        </form>
                        <form action="/deleteuca" class="delete-form" data-delete="uca" method="POST" style="display: inline-block; float: left;">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <input type="hidden" name="controlaction_id" id="controlaction_id" value="{{$ca->id}}">
                            <input type="hidden" name="safety_constraint_id" id="safety_constraint_id" value="{{$sc->id}}">
                            <input type="image" src="{{ asset('images/trash.png') }}" alt="Delete" width="20" class="navbar__logo">
                        </form>
                    </div>
                    
                </div>
            @endforeach

        </div>     

    </div>

</div>