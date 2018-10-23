<?php
    // Getting all variables
    // $variables = App\Variable::where('project_id', $project_id)->where('controller_id', $ca->controller->id)->orWhere('controller_id', 0)->orderBy('id')->get();
    $variables = App\Variable::where('project_id', $project_id)->whereIn('controller_id', [0, $ca->controller->id])->orderBy('id')->get();
    // Getting all States
    $states = [];
    //Selecting the divisor
    $divisor_num = [];
    foreach($variables as $variable){
        $state = App\State::where('variable_id', $variable->id)->orderBy('id')->get();
        foreach ($state as $s) {
            array_push($states, $s);
        }
    }
    //App\State::all();
    // Index of current variable (pivot_2 for the loop)
    $variable_index = 0;
    // Fix pivot to last element in array
    $pivot = count($variables) - 1;
    // Fix the pivot_2 to the pivot
    $pivot_2 = $pivot;
    // The current row of the context table
    $loop = 0;
    $arr = array();
    $pos = 0;
    $allStates = [];


    /*  
     *  Create a new array ($allStates) containing all states of all variables
     *  Ex: Variable 1 (State 1, State 2) and Variable 2 (State 3 and State 4)
     *  Resulting array: array([0] => array(State 1, State 2), [1] => array(State 3, State 4))
     *  Array ($allStatesId) follows the same rule, but I saved the ID and not the name
     *  Array ($allVariablesId) stores the variable_id of each state_id
     */
    for($i = 0; $i < count($variables); $i++) {
        $allStates[$variable_index] = [];
        $allStatesId[$variable_index] = [];
        $allVariablesId[$variable_index] = [];
        for ($j = 0; $j < count($states); $j++) {
            if ($variables[$i]->id == $states[$j]->variable_id){    
                array_push($allStates[$variable_index], $states[$j]->name);
                array_push($allStatesId[$variable_index], $states[$j]->id);
                array_push($allVariablesId[$variable_index], $states[$j]->variable_id);
            }
        }
        $variable_index++;
    }

    $total_loop = 1;

    // The number of all loops (The total number of the context table rows)
    /*
     * Ex: Variable 1 (State 1, State 2) and Variable 2 (State 3 and State 4)
     * Number of total loops: (2 states of Variable 1 x 2 states of variable 2 = 4 rows)
     */
    for ($i = 0; $i < count($allStates); $i++) {
        $number_of_states[$i] = count($allStates[$i]);
        $combination_array[$i] = 0;
        $total_loop *= count($allStates[$i]);
    }

    $divisor_num[count($allStates)-1] = 1;
    for ($i = count($allStates)-1; $i > 0; $i--) {
        $divisor_num[$i-1] = $divisor_num[$i] * $number_of_states[$i];
    }

    $rows_number = $total_loop;

    // Select all rules associated with the selected control action
    $rule = App\Rules::where('controlaction_id', $ca->id)->get();
    // Get the number of rules
    $total_index = App\Rules::distinct()->select('index')->where('controlaction_id', $ca->id)->get();
    // Array to store the rules
    $rle = [];
    if (count($total_index) > 0) {
        foreach($total_index as $index) {
            array_push($rle, App\Rules::where('controlaction_id', $ca->id)->where('index', $index->index)->orderBy('index')->orderBy('variable_id')->get());
        }
    }

    // BubbleSort to order the rules. For some reason, the sql "orderBy" is not working.
    if (count($rle) > 0){
        for ($i = 0; $i < count($rle)-1; $i++){
            for ($j = $i+1; $j < count($rle); $j++){
                if ($rle[$i][0]["index"] > $rle[$j][0]["index"]){
                    $aux = $rle[$i];
                    $rle[$i] = $rle[$j];
                    $rle[$j] = $aux;
                }
            }
        }
    }

    
    

?>

<div class="substep__title">
    Context Table - {{$ca->name}}
</div>

<div class="substep__content">
@if (count($variables) > 0)
    <div class="legend-contexttable">
        <div class="container">
            <div class="container-fluid" style="margin-top: 10px">
                <div class="table-row header-blue">
                    <div class="text center">Legend</div>
                </div>
                <div class="table-row">
                    <select class="legend-select" disabled="">
                        <option>-</option>
                    </select>
                    <div class="text legend-content"> Default value - The context was not modified</div>
                </div>
                <div class="table-row">
                    <select class="legend-select" disabled="">
                        <option></option>
                    </select>
                    <div class="text legend-content"> The Control Action in this context is not Unsafe (it is safe or indifferent)</div>
                </div>
                <div class="table-row">
                    <select class="legend-select" disabled="">
                        <option>Hazardous</option>
                    </select>
                    <div class="text legend-content"> The Control Action in this context is Unsafe</div>
                </div>
                <div class="table-row">
                    <select class="legend-select-error" disabled="">
                        <option>-</option>
                    </select>
                    <div class="text legend-content">Error on saving the Context Table. Please, fill the field again</div>
                </div>
            </div>
        </div>
    </div>

    @if ($rows_number > 1)
        <button class="legend-button">SEE TABLE LEGEND</button> - This context table has <b>{{$rows_number}}</b> rows
    @else
        <button class="legend-button">SEE TABLE LEGEND</button> - This context table has <b>{{$rows_number}}</b> row
    @endif

    <div class="warning-message" id="warning-message-ca-{{$ca->id}}">
    </div>

    <div class="container">

        <div class="container-fluid" style="margin-top: 10px">

            <form action="/savecontexttable" method="POST" class="save-context-table">

                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <input type="hidden" id="controlaction_id" name="controlaction_id" value="{{$ca->id}}">
                <input type="hidden" id="controlaction_name_{{$ca->id}}" name="controlaction_name_{{$ca->id}}" value="{{$ca->name}}">
                <input type="hidden" id="controller_name_{{$ca->id}}" name="controller_name_{{$ca->id}}" value="{{$ca->controller->name}}">
                <input type="hidden" id="total_rows" name="total_rows" value="{{$total_loop}}">

                <div class="table-row header">
                <!--Div in blank for the number of the rows -->
                <div class="number-contexttable">#</div>
                @foreach ($variables as $variable)
                    <div class="text">{{$variable->name}}</div>
                    <input type="hidden" id="varible-name-id-{{$variable->id}}" name="varible-name-id-{{$variable->id}}" value="{{$variable->name}}">
                @endforeach
                <div class="text">Index Rule</div>
                <div class="text">Control Action provided</div>
                <div class="text">Control Action not provided</div>
                <div class="text">Wrong order of Control Action</div>
                <div class="text">Control Action provided too early</div>
                <div class="text">Control Action provided too late</div>
                <div class="text">Control Action stopped too soon</div>
                <div class="text">Control Action applied too long</div>

                </div>

                @while($total_loop > 0)
                <?php
                    $columns = [];
                    $rules = [];
                    foreach($total_index as $index) {
                        array_push($rules, "true");
                    }
                ?>
                    <div class="table-row center">

                        <div class="number-contexttable">
                            <?php
                                echo abs($rows_number - $total_loop + 1).".";
                            ?>
                        </div>

                        @for($i = 0; $i < count($allStates); $i++)
                            
                            <div class="text">
                                {{$allStates[$i][$combination_array[$i]]}}<br/>
                                <input type="hidden" id="name-state-id-{{$allStatesId[$i][$combination_array[$i]]}}" name="name-state-id-{{$allStatesId[$i][$combination_array[$i]]}}" value="{{$allStates[$i][$combination_array[$i]]}}">
                                <input type="hidden" id="associated-variable-id-{{$allStatesId[$i][$combination_array[$i]]}}" name="associated-variable-id-{{$allStatesId[$i][$combination_array[$i]]}}" value="{{$allVariablesId[$i][$combination_array[$i]]}}">
                            </div>
                            <?php
                                array_push($arr, $allStatesId[$i][$combination_array[$i]]);
                                // Verifying if the rule fits
                                if(count($rle) > 0) {
                                    foreach($rle as $key => $r) {                                        
                                        if (count($r) > 0) {                                        
                                            if($r[$i]->state_id == 0){                                            
                                                if ($rules[$key] == "true"){
                                                    $rules[$key] = "true";
                                                    $columns[$key] = $r[$i]->column;
                                                }
                                            } else if ( ($allStates[$i][$combination_array[$i]] == App\State::find($r[$i]->state_id)->name) && ($rules[$key] == "true") ){
                                                $rules[$key] = "true";
                                                $columns[$key] = $r[$i]->column;
                                            } else {
                                                $rules[$key] = "false";
                                                $columns[$key] = $r[$i]->column;
                                            }                                            
                                        }
                                    }
                                }

                            ?>
                        @endfor

                        <?php
                        // Logic to do all combinations of the context table
                        $arr = json_encode($arr);
                            $loop++;
                            for ($i = 0; $i < count($combination_array); $i++) {
                                $multiple = (count($combination_array)-($i+1));
                                $divisor = $divisor_num[$i];
                                $resto = $loop % $divisor;
                                if ($resto == 0) {
                                    $combination_array[$i] = ($combination_array[$i]+1 >= $number_of_states[$i]) ? 0 : $combination_array[$i]+1;
                                }
                            }
                            
                            $total_loop--;
                        ?>                

                        

                        <div class="text" id="rule-row-{{$total_loop}}" name="rule-row-{{$total_loop}}">
                        <?php
                            $array_for_compare = $arr;
                            $array_for_compare = str_replace("[", "", $array_for_compare);
                            $array_for_compare = str_replace("]", "", $array_for_compare);
                            $arr = array();
                            $thereAreRule = "false";
                            $column_name = array (
                                "Provided" => false,
                                "Not Provided" => false,
                                "Provided too early" => false,
                                "Provided too late" => false,
                                "Wrong order" => false,
                                "Stopped too soon" => false,
                                "Applied too long" => false
                            );

                            foreach ($rules as $key => $r) {
                                if ($r == "true" && count($r) > 0) {
                                    echo "R".($key+1)." ";
                                    $thereAreRule = "true";
                                    $columns_that_rule_can_be_applied = explode(";", $columns[0]);
                                    //print_r($columns_that_rule_can_be_applied);
                                    foreach($columns_that_rule_can_be_applied as $column_rule)
                                        $column_name[$column_rule] = true;                                    
                                } else {
                                    $r[$key] = "false";
                                }
                            }                            
                            $context_table = DB::select('SELECT * FROM context_tables WHERE controlaction_id = ? and ? like concat("%",context,"%") ORDER BY context', [$ca->id, $array_for_compare]);
                            $context_table = (count($context_table) > 0) ? $context_table[0] : "";

                        ?>
                        </div>

                        <input type="hidden" id="all_states_{{$total_loop}}" name="all_states_{{$total_loop}}" value="{{$array_for_compare}}">

                        @if (App\ContextTable::where('controlaction_id', $ca->id)->count() > 0)
                            
                            <!-- Error fixed: Some rows of the Context Table were not properly recorded. We fixed the error verifing if every row is filled. -->
                            @if ($context_table != null)
                                <!--Control Action Provided-->
                                @if ($thereAreRule == "true" && $column_name["Provided"] == true)
                                    <select class="text" id="provided-ca-{{$ca->id}}-row-{{$total_loop}}" name="ca-provided-ca-{{$ca->id}}-row-{{$total_loop}}" disabled>
                                @else
                                    <select class="text" id="provided-ca-{{$ca->id}}-row-{{$total_loop}}" name="ca-provided-ca-{{$ca->id}}-row-{{$total_loop}}">
                                @endif
                                        @if($context_table->ca_provided == "true")
                                            <option value="null">?</option>
                                            <option value="false"> </option>
                                            <option value="true" selected>Hazardous</option>
                                        @elseif($context_table->ca_provided == "null")
                                            <option value="null" selected>-</option>
                                            <option value="false"> </option>
                                            <option value="true">Hazardous</option>
                                        @else
                                            <option value="null">?</option>
                                            <option value="false" selected> </option>
                                            <option value="true">Hazardous</option>
                                        @endif
                                    </select>

                                <!--Control action not provided-->
                                @if ($thereAreRule == "true" && $column_name["Not Provided"] == true)
                                    <select class="text" id="notprovided-ca-{{$ca->id}}-row-{{$total_loop}}" name="ca-not-provided-ca-{{$ca->id}}-row-{{$total_loop}}" disabled>
                                @else
                                    <select class="text" id="notprovided-ca-{{$ca->id}}-row-{{$total_loop}}" name="ca-not-provided-ca-{{$ca->id}}-row-{{$total_loop}}">
                                @endif
                                    @if($context_table->ca_not_provided == "null")
                                        <option value="null" selected>-</option>
                                        <option value="false"> </option>
                                        <option value="true">Hazardous</option>
                                    @elseif($context_table->ca_not_provided == "true")
                                        <option value="null">?</option>
                                        <option value="false"> </option>
                                        <option value="true" selected>Hazardous</option>
                                    @else
                                        <option value="null">?</option>
                                        <option value="false" selected> </option>
                                        <option value="true">Hazardous</option>
                                    @endif
                                </select>

                                <!-- Wrong time or order causes hazard-->
                                @if ($thereAreRule == "true" && $column_name["Wrong order"] == true)
                                    <select class="text" id="wrongtime-ca-{{$ca->id}}-row-{{$total_loop}}" name="wrongtime-ca-{{$ca->id}}-row-{{$total_loop}}" disabled>
                                @else
                                    <select class="text" id="wrongtime-ca-{{$ca->id}}-row-{{$total_loop}}" name="wrongtime-ca-{{$ca->id}}-row-{{$total_loop}}">
                                @endif
                                    @if($context_table->wrong_time_order == "null")
                                        <option value="null" selected>-</option>
                                        <option value="false"> </option>
                                        <option value="true">Hazardous</option>
                                    @elseif($context_table->wrong_time_order == "true")
                                        <option value="null">?</option>
                                        <option value="false"> </option>
                                        <option value="true" selected>Hazardous</option>
                                    @else
                                        <option value="null">?</option>
                                        <option value="false" selected> </option>
                                        <option value="true">Hazardous</option>
                                    @endif
                                </select>

                                <!--Control Action provided too early-->
                                @if ($thereAreRule == "true" && $column_name["Provided too early"] == true)
                                    <select class="text" id="early-ca-{{$ca->id}}-row-{{$total_loop}}" name="early-ca-{{$ca->id}}-row-{{$total_loop}}" disabled>
                                @else
                                    <select class="text" id="early-ca-{{$ca->id}}-row-{{$total_loop}}" name="early-ca-{{$ca->id}}-row-{{$total_loop}}">
                                @endif
                                    @if($context_table->ca_too_early == "null")
                                        <option value="null" selected>-</option>
                                        <option value="false"> </option>
                                        <option value="true">Hazardous</option>
                                    @elseif($context_table->ca_too_early == "true")
                                        <option value="null">?</option>
                                        <option value="false"> </option>
                                        <option value="true" selected>Hazardous</option>
                                    @else
                                        <option value="null">?</option>
                                        <option value="false" selected> </option>
                                        <option value="true">Hazardous</option>
                                    @endif
                                </select>

                                <!--Control Action provided too late-->
                                @if ($thereAreRule == "true" && $column_name["Provided too late"] == true)
                                    <select class="text" id="late-ca-{{$ca->id}}-row-{{$total_loop}}" name="late-ca-{{$ca->id}}-row-{{$total_loop}}" disabled>
                                @else
                                    <select class="text" id="late-ca-{{$ca->id}}-row-{{$total_loop}}" name="late-ca-{{$ca->id}}-row-{{$total_loop}}">
                                @endif
                                    @if($context_table->ca_too_late == "null")
                                        <option value="null" selected>-</option>
                                        <option value="false"> </option>
                                        <option value="true">Hazardous</option>
                                    @elseif($context_table->ca_too_late == "true")
                                        <option value="null">?</option>
                                        <option value="false"> </option>
                                        <option value="true" selected>Hazardous</option>
                                    @else
                                        <option value="null">?</option>
                                        <option value="false" selected> </option>
                                        <option value="true">Hazardous</option>
                                    @endif
                                </select>
                                <!--Control action stopped too soon-->
                                @if ($thereAreRule == "true" && $column_name["Stopped too soon"] == true)
                                    <select class="text" id="soon-ca-{{$ca->id}}-row-{{$total_loop}}" name="soon-ca-{{$ca->id}}-row-{{$total_loop}}" disabled>
                                @else
                                    <select class="text" id="soon-ca-{{$ca->id}}-row-{{$total_loop}}" name="soon-ca-{{$ca->id}}-row-{{$total_loop}}">
                                @endif
                                    @if($context_table->ca_too_soon == "null")
                                        <option value="null" selected>-</option>
                                        <option value="false"> </option>
                                        <option value="true">Hazardous</option>
                                    @elseif($context_table->ca_too_soon == "true")
                                        <option value="null">?</option>
                                        <option value="false"> </option>
                                        <option value="true" selected>Hazardous</option>
                                    @else
                                        <option value="null">?</option>
                                        <option value="false" selected> </option>
                                        <option value="true">Hazardous</option>
                                    @endif
                                </select>
                                <!--Control Action applied too long-->
                                @if ($thereAreRule == "true" && $column_name["Applied too long"] == true)
                                    <select class="text" id="long-ca-{{$ca->id}}-row-{{$total_loop}}" name="long-ca-{{$ca->id}}-row-{{$total_loop}}" disabled>
                                @else
                                    <select class="text" id="long-ca-{{$ca->id}}-row-{{$total_loop}}" name="long-ca-{{$ca->id}}-row-{{$total_loop}}">
                                @endif
                                    @if($context_table->ca_too_long == "null")
                                        <option value="null" selected>-</option>
                                        <option value="false"> </option>
                                        <option value="true">Hazardous</option>
                                    @elseif($context_table->ca_too_long == "true")
                                        <option value="null">?</option>
                                        <option value="false"> </option>
                                        <option value="true" selected>Hazardous</option>
                                    @else
                                        <option value="null">?</option>
                                        <option value="false" selected> </option>
                                        <option value="true">Hazardous</option>
                                    @endif
                                </select>
                            @else
                                <!-- Fixing the error of missing rows (the ones that were not properly stored) -->
                                @if ($thereAreRule == "true" && $column_name["Provided"] == true)
                                <select class="text" id="provided-ca-{{$ca->id}}-row-{{$total_loop}}" name="ca-provided-ca-{{$ca->id}}-row-{{$total_loop}}" disabled>
                            @else
                                <select class="text_error" id="provided-ca-{{$ca->id}}-row-{{$total_loop}}" name="ca-provided-ca-{{$ca->id}}-row-{{$total_loop}}">
                            @endif
                                    <option value="null">?</option>
                                    <option value="false"> </option>
                                    @if ($thereAreRule == "true" && $column_name["Provided"] == true)
                                        <option value="true" selected>Hazardous</option>
                                    @else
                                        <option value="true">Hazardous</option>
                                    @endif
                                </select>

                            <!--Control action not provided-->
                            @if ($thereAreRule == "true" && $column_name["Not Provided"] == true)
                                <select class="text" id="notprovided-ca-{{$ca->id}}-row-{{$total_loop}}" name="ca-not-provided-ca-{{$ca->id}}-row-{{$total_loop}}" disabled>
                            @else
                                <select class="text_error" id="notprovided-ca-{{$ca->id}}-row-{{$total_loop}}" name="ca-not-provided-ca-{{$ca->id}}-row-{{$total_loop}}">
                            @endif
                                <option value="false"> </option>
                                <option value="null">?</option>
                                @if ($thereAreRule == "true" && $column_name["Not Provided"] == true)
                                    <option value="true" selected>Hazardous</option>
                                @else
                                    <option value="true">Hazardous</option>
                                @endif
                            </select>

                            <!--Wrong time or order causes hazard-->
                            @if ($thereAreRule == "true" && $column_name["Wrong order"] == true)
                                <select class="text" id="wrongtime-ca-{{$ca->id}}-row-{{$total_loop}}" name="wrongtime-ca-{{$ca->id}}-row-{{$total_loop}}" disabled>
                            @else
                                <select class="text_error" id="wrongtime-ca-{{$ca->id}}-row-{{$total_loop}}" name="wrongtime-ca-{{$ca->id}}-row-{{$total_loop}}">
                            @endif
                                <option value="null">?</option>
                                <option value="false"> </option>
                                @if ($thereAreRule == "true" && $column_name["Wrong order"] == true)
                                    <option value="true" selected>Hazardous</option>
                                @else
                                    <option value="true">Hazardous</option>
                                @endif
                            </select>

                            <!--Control Action provided too early-->
                            @if ($thereAreRule == "true" && $column_name["Provided too early"] == true)
                                <select class="text" id="early-ca-{{$ca->id}}-row-{{$total_loop}}" name="early-ca-{{$ca->id}}-row-{{$total_loop}}" disabled>
                            @else
                                <select class="text_error" id="early-ca-{{$ca->id}}-row-{{$total_loop}}" name="early-ca-{{$ca->id}}-row-{{$total_loop}}">
                            @endif
                                <option value="null">?</option>
                                <option value="false"> </option>
                                @if ($thereAreRule == "true" && $column_name["Provided too early"] == true)
                                    <option value="true" selected>Hazardous</option>
                                @else
                                    <option value="true">Hazardous</option>
                                @endif
                            </select>

                            <!--Control Action provided too late-->
                            @if ($thereAreRule == "true" && $column_name["Provided too late"] == true)
                                <select class="text" id="late-ca-{{$ca->id}}-row-{{$total_loop}}" name="late-ca-{{$ca->id}}-row-{{$total_loop}}" disabled>
                            @else
                                <select class="text_error" id="late-ca-{{$ca->id}}-row-{{$total_loop}}" name="late-ca-{{$ca->id}}-row-{{$total_loop}}">
                            @endif
                                <option value="null">?</option>
                                <option value="false"> </option>
                                @if ($thereAreRule == "true" && $column_name["Provided too late"] == true)
                                    <option value="true" selected>Hazardous</option>
                                @else
                                    <option value="true">Hazardous</option>
                                @endif
                            </select>

                            <!--Control action stopped too soon-->
                            @if ($thereAreRule == "true" && $column_name["Stopped too soon"] == true)
                                <select class="text" id="soon-ca-{{$ca->id}}-row-{{$total_loop}}" name="soon-ca-{{$ca->id}}-row-{{$total_loop}}" disabled>
                            @else
                                <select class="text_error" id="soon-ca-{{$ca->id}}-row-{{$total_loop}}" name="soon-ca-{{$ca->id}}-row-{{$total_loop}}">
                            @endif
                                <option value="null">?</option>
                                <option value="false"> </option>
                                @if ($thereAreRule == "true" && $column_name["Stopped too soon"] == true)
                                    <option value="true" selected>Hazardous</option>
                                @else
                                    <option value="true">Hazardous</option>
                                @endif
                            </select>

                            <!--Control Action applied too long-->
                            @if ($thereAreRule == "true" && $column_name["Applied too long"] == true)
                                <select class="text" id="long-ca-{{$ca->id}}-row-{{$total_loop}}" name="long-ca-{{$ca->id}}-row-{{$total_loop}}" disabled>
                            @else
                                <select class="text_error" id="long-ca-{{$ca->id}}-row-{{$total_loop}}" name="long-ca-{{$ca->id}}-row-{{$total_loop}}">
                            @endif
                                <option value="null">?</option>
                                <option value="false"> </option>
                                @if ($thereAreRule == "true" && $column_name["Applied too long"] == true)
                                    <option value="true" selected>Hazardous</option>
                                @else
                                    <option value="true">Hazardous</option>
                                @endif
                            </select>


                            @endif
                        @else
                            <!--Control Action Provided-->
                            @if ($thereAreRule == "true" && $column_name["Provided"] == true)
                                <select class="text" id="provided-ca-{{$ca->id}}-row-{{$total_loop}}" name="ca-provided-ca-{{$ca->id}}-row-{{$total_loop}}" disabled>
                            @else
                                <select class="text" id="provided-ca-{{$ca->id}}-row-{{$total_loop}}" name="ca-provided-ca-{{$ca->id}}-row-{{$total_loop}}">
                            @endif
                                    <option value="null">?</option>
                                    <option value="false"> </option>
                                    @if ($thereAreRule == "true" && $column_name["Provided"] == true)
                                        <option value="true" selected>Hazardous</option>
                                    @else
                                        <option value="true">Hazardous</option>
                                    @endif
                                </select>

                            <!--Control action not provided-->
                            @if ($thereAreRule == "true" && $column_name["Not Provided"] == true)
                                <select class="text" id="notprovided-ca-{{$ca->id}}-row-{{$total_loop}}" name="ca-not-provided-ca-{{$ca->id}}-row-{{$total_loop}}" disabled>
                            @else
                                <select class="text" id="notprovided-ca-{{$ca->id}}-row-{{$total_loop}}" name="ca-not-provided-ca-{{$ca->id}}-row-{{$total_loop}}">
                            @endif
                                <option value="null">?</option>
                                <option value="false"> </option>
                                @if ($thereAreRule == "true" && $column_name["Not Provided"] == true)
                                    <option value="true" selected>Hazardous</option>
                                @else
                                    <option value="true">Hazardous</option>
                                @endif
                            </select>

                            <!--Wrong time or order causes hazard-->
                            @if ($thereAreRule == "true" && $column_name["Wrong order"] == true)
                                <select class="text" id="wrongtime-ca-{{$ca->id}}-row-{{$total_loop}}" name="wrongtime-ca-{{$ca->id}}-row-{{$total_loop}}" disabled>
                            @else
                                <select class="text" id="wrongtime-ca-{{$ca->id}}-row-{{$total_loop}}" name="wrongtime-ca-{{$ca->id}}-row-{{$total_loop}}">
                            @endif
                                <option value="null">?</option>
                                <option value="false"> </option>
                                @if ($thereAreRule == "true" && $column_name["Wrong order"] == true)
                                    <option value="true" selected>Hazardous</option>
                                @else
                                    <option value="true">Hazardous</option>
                                @endif
                            </select>

                            <!--Control Action provided too early-->
                            @if ($thereAreRule == "true" && $column_name["Provided too early"] == true)
                                <select class="text" id="early-ca-{{$ca->id}}-row-{{$total_loop}}" name="early-ca-{{$ca->id}}-row-{{$total_loop}}" disabled>
                            @else
                                <select class="text" id="early-ca-{{$ca->id}}-row-{{$total_loop}}" name="early-ca-{{$ca->id}}-row-{{$total_loop}}">
                            @endif
                                <option value="null">?</option>
                                <option value="false"> </option>
                                @if ($thereAreRule == "true" && $column_name["Provided too early"] == true)
                                    <option value="true" selected>Hazardous</option>
                                @else
                                    <option value="true">Hazardous</option>
                                @endif
                            </select>

                            <!--Control Action provided too late-->
                            @if ($thereAreRule == "true" && $column_name["Provided too late"] == true)
                                <select class="text" id="late-ca-{{$ca->id}}-row-{{$total_loop}}" name="late-ca-{{$ca->id}}-row-{{$total_loop}}" disabled>
                            @else
                                <select class="text" id="late-ca-{{$ca->id}}-row-{{$total_loop}}" name="late-ca-{{$ca->id}}-row-{{$total_loop}}">
                            @endif
                                <option value="null">?</option>
                                <option value="false"> </option>
                                @if ($thereAreRule == "true" && $column_name["Provided too late"] == true)
                                    <option value="true" selected>Hazardous</option>
                                @else
                                    <option value="true">Hazardous</option>
                                @endif
                            </select>

                            <!--Control action stopped too soon-->
                            @if ($thereAreRule == "true" && $column_name["Stopped too soon"] == true)
                                <select class="text" id="soon-ca-{{$ca->id}}-row-{{$total_loop}}" name="soon-ca-{{$ca->id}}-row-{{$total_loop}}" disabled>
                            @else
                                <select class="text" id="soon-ca-{{$ca->id}}-row-{{$total_loop}}" name="soon-ca-{{$ca->id}}-row-{{$total_loop}}">
                            @endif
                                <option value="null">?</option>
                                <option value="false"> </option>
                                @if ($thereAreRule == "true" && $column_name["Stopped too soon"] == true)
                                    <option value="true" selected>Hazardous</option>
                                @else
                                    <option value="true">Hazardous</option>
                                @endif
                            </select>

                            <!--Control Action applied too long-->
                            @if ($thereAreRule == "true" && $column_name["Applied too long"] == true)
                                <select class="text" id="long-ca-{{$ca->id}}-row-{{$total_loop}}" name="long-ca-{{$ca->id}}-row-{{$total_loop}}" disabled>
                            @else
                                <select class="text" id="long-ca-{{$ca->id}}-row-{{$total_loop}}" name="long-ca-{{$ca->id}}-row-{{$total_loop}}">
                            @endif
                                <option value="null">?</option>
                                <option value="false"> </option>
                                @if ($thereAreRule == "true" && $column_name["Applied too long"] == true)
                                    <option value="true" selected>Hazardous</option>
                                @else
                                    <option value="true">Hazardous</option>
                                @endif
                            </select>

                        @endif
                    </div>
                @endwhile
                <br/><center><button class="font-button"><img src="/images/save.ico" class="context-table-button" width="15"/> Save Context Table</button></center>
            </form>
            </br>
            <center>
                <form action="#" method="POST" class="clear-context-table">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <input type="hidden" id="controlaction_id" name="controlaction_id" value="{{$ca->id}}">
                        <input type="hidden" id="total_rows" name="total_rows" value="{{$rows_number}}">
                        <button class="font-button" id="delete"><img src="/images/trash.png" class="context-table-button" width="15"/> Clear Context Table </button>
                </form>
            </center>
        </div>
    </div>
@endif
</div>
