<div class="substep__title">
    Rules - {{$ca->name}}
</div>

<div class="substep__content">

    @if (App\Variable::where('project_id', $project_id)->whereIn('controller_id', [0, $controller->id])->count())
    <div class="container">

        <div class="container-fluid control-action-{{$ca->id}}" style="margin-top: 10px">

            <div class="table-row header">
                <div class="text">Rule Index</div>
                <div class="text">Column(s)</div>
                @foreach (App\Variable::where('project_id', $project_id)->whereIn('controller_id', [0, $controller->id])->orderBy('id', 'asc')->get() as $variable)
                    <div class="text">{{$variable->name}}</div>
                @endforeach
                <div class="text">Associated Hazards</div>
                <div class="content-uca">
                    <!-- Header to delete a rule -->
                </div>
            </div>

            @foreach (App\Rule::where('controlaction_id', $ca->id)->orderBy('id', 'asc')->select('id', 'column')->distinct()->get() as $key => $rule)
                <div  id="rule-{{$rule->id}}-{{$ca->id}}-view" class="table-row rules-table rules-ca-{{$ca->id}}-rule-{{$rule->id}}">

                    <div  class="table-row">
                        <div class="text">R{{$key + 1}}</div>
                        <div class="text center">
                            <?php
                                $name_of_the_columns = explode(";", $rule->column);
                                $final_column_name = "";
                                for($index = 0; $index < count($name_of_the_columns); $index++){
                                    if ($index > 0 && $index < count($name_of_the_columns) - 1)
                                        $final_column_name .= ", " . $name_of_the_columns[$index];
                                    else if ($index == 0){
                                        $final_column_name = $name_of_the_columns[$index];
                                    } else {
                                        $final_column_name .= " and " . $name_of_the_columns[$index];
                                    }
                                }
                            ?>
                            {{$final_column_name}}
                        </div>
                        @foreach (App\RulesVariablesStates::where('rule_id', $rule->id)->orderBy('variable_id', 'asc')->get() as $rule_variable)
                            @if ($rule_variable->state_id == 0)
                                <div class="text center">ANY</div>
                            @else
                                <div class="text center">{{App\State::find($rule_variable->state_id)->name}}</div>
                            @endif
                        @endforeach

                        <?php
                            $rules_hazards = App\RulesSafetyConstraintsHazards::where('rule_id', $rule->id)->groupBy('hazard_id')->get();
                            $len = count($rules_hazards);
                            $i = 0;
                            

                            if($len == 0){
                                 echo '<div class="text center">&nbsp</div>';
                            }
                            else if($len == 1){
                                $hazard = App\Hazards::where('id', $rules_hazards[0]->hazard_id)->first();

                                echo '<div class="text center"> <a title="'. $hazard->name . '">[H-'. $hazard_map[$hazard->id] .']</a></div>';
                            }
                            else if ($len == 2){
                                $hazard1 = App\Hazards::where('id', $rules_hazards[0]->hazard_id)->first();
                                $hazard2 = App\Hazards::where('id', $rules_hazards[1]->hazard_id)->first();

                                echo '<div class="text center"> <a title="'. $hazard1->name .'">[H-'. $hazard_map[$hazard1->id].']</a> and <a title="' . $hazard2->name . '">[H-'. $hazard_map[$hazard2->id] .']</a></div>';
                            }
                            else if($len > 0){
                                $hazardsList = '<div class="text center">';

                                foreach ($rules_hazards as $key => $rule_hazard){
                                    $hazard = App\Hazards::where('id', $rule_hazard->hazard_id)->first();

                                    if($i != $len-1)
                                        $hazardsList .= "<a title='". $hazard->name ."'>[H-".$hazard_map[$rule_hazard->hazard_id].']</a>,';
                                    else
                                        $hazardsList .= "<a title='". $hazard->name ."'>[H-".$hazard_map[$rule_hazard->hazard_id].']</a></div>';

                                    $i++;
                                }

                                echo $hazardsList;
                            }
                            

                        ?>


                        <div class="content-uca">
                            <form action="/editrule" class="edit-rule-form" data-edit="rules" method="POST">
                                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                                    <input type="hidden" name="controlaction_id" id="controlaction_id" value="{{$ca->id}}">
                                    <input type="hidden" name="rule_id" id="rule_id" value="{{$rule->id}}">
                                    <input type="image" src="{{ asset('images/edit.ico') }}" alt="Edit" width="20" class="navbar__logo">
                            </form>

                            <form action="/deleterule" class="delete-form" data-delete="rules" method="POST">
                                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                                    <input type="hidden" name="controlaction_id" id="controlaction_id" value="{{$ca->id}}">
                                    <input type="hidden" name="rule_id" id="rule_id" value="{{$rule->id}}">
                                    <input type="image" src="{{ asset('images/trash.png') }}" alt="Delete" width="20" class="navbar__logo">
                            </form>
                        </div>
                    </div>
                </div>
                <form action="/editrule" class="edit-rule-form" data-edit="rules" method="POST">
                    
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <input type="hidden" id="controlaction_id" name="controlaction_id" value="{{$ca->id}}">
                    
                    <div class="table-row" id="rule-{{$rule->id}}-{{$ca->id}}-edition" style='display: none;'>
                        <div class="edit-rule-field">R{{$key + 1}}</div>

                        <?php 
                            $column_selected_aux = array (
                                "Provided" => false,
                                "Not Provided" => false,
                                "Provided too early" => false,
                                "Provided too late" => false,
                                "Wrong order" => false,
                                "Stopped too soon" => false,
                                "Applied too long" => false
                            );
                            foreach($name_of_the_columns as $column){
                                $column_selected_aux[$column] = true;
                            }
                        ?>
                        <div class="edit-rule-field">
                            <select id="rule_column_edition" name="rule_column"  class="select_from_form_rule" multiple required title=""> 
                                <option class="option_text" value="Provided" <?php echo (($column_selected_aux['Provided'] == 1)? 'selected' : ''); ?> > Provided </option>

                                <option class="option_text" value="Not Provided" <?php echo (($column_selected_aux['Not Provided'] == 1)? 'selected' : ''); ?> > Not Provided</option>

                                <option class="option_text" value="Provided too early" <?php echo (($column_selected_aux['Provided too early'] == 1)? 'selected' : ''); ?> > Provided too early </option>

                                <option class="option_text" value="Provided too late"<?php echo (($column_selected_aux['Provided too late'] == 1)? 'selected' : ''); ?> > Provided too late </option>

                                <option class="option_text" value="Wrong order" <?php echo (($column_selected_aux['Wrong order'] == 1)? 'selected' : '') ; ?> > Wrong order</option>

                                <option class="option_text" value="Stopped too soon" <?php echo (($column_selected_aux['Stopped too soon'] == 1)? 'selected' : '') ; ?> > Stopped too soon </option>

                                <option class="option_text" value="Applied too long" <?php echo  (($column_selected_aux['Applied too long'] == 1)? 'selected' : '') ; ?> > Applied too long </option>
                            </select>
                        </div>
                        
                        
                       @foreach (App\RulesVariablesStates::where('rule_id', $rule->id)->orderBy('variable_id', 'asc')->get() as $rule_variable)
                            <select id="variable_id_{{$rule_variable->variable_id}}" name="variable_id_{{$rule_variable->variable_id}}" class="edit-rule-field">
                                <option value="{{$rule_variable->variable_id}}-0" name="ANY">ANY</option>
                                @foreach (App\State::where('variable_id', $rule_variable->variable_id)->get() as $state)
                                    @if ($rule_variable->state_id == $state->id)
                                        <option value="{{$rule_variable->variable_id}}-{{$state->id}}" name="{{$state->name}}" selected="true">{{$state->name}}</option>
                                    @else
                                        <option value="{{$rule_variable->variable_id}}-{{$state->id}}" name="{{$state->name}}">{{$state->name}}</option>
                                    @endif
                                @endforeach
                            </select>
                        @endforeach

                        <?php
                            $rulesHazards = App\RulesSafetyConstraintsHazards::where('rule_id', $rule->id)->groupBy('hazard_id')->get();
                        ?>

                        <div class="edit-rule-field">
                            <select id="hazard_column_edition" name="hazard_column" class="select_from_form_rule"  multiple required title="">
                                @foreach(App\Hazards::where('project_id', $project_id)->orderBy('id', 'asc')->get() as $hazard)
                                    @if($rulesHazards->contains('hazard_id', $hazard->id))
                                        <option class="option_text" value="{{$hazard->id}}" selected> [H-{{$hazard_map[$hazard->id]}}] {{$hazard->name}}</option>
                                    @else
                                        <option class="option_text" value="{{$hazard->id}}"> [H-{{$hazard_map[$hazard->id]}}] {{$hazard->name}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                         
                            
                        <div class="content-uca">
                            
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <input type="hidden" name="controlaction_id" id="controlaction_id" value="{{$ca->id}}">
                            <input type="hidden" name="rule_id" id="rule_id" value="{{$rule->id}}">
                            <input type="image" src="{{ asset('images/save.ico') }}" alt="Edit" width="20" class="navbar__logo">
                            <img id="cancel-edit-rule-{{$rule->id}}" name="{{$rule->id}}-{{$ca->id}}" src="{{ asset('images/delete.ico') }}" alt="Edit" width="20" class="navbar__logo">
                        </div>
                    </div>
                </form>
                    
                
            @endforeach 

        </div>     

    </div>
    </br>
    <center>
        <form action="/deleteallrules" method="POST" class="delete-all-rules">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <input type="hidden" id="controlaction_id" name="controlaction_id" value="{{$ca->id}}">
                <button class="font-button" id="delete"><img src="/images/trash.png" class="steptwo-button" width="15"/> Delete all Rules
        </button>
        </form>
    </center>
    @endif
</div>