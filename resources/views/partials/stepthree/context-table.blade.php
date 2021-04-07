<?php
    // Getting all variables
    // $variables = App\Variable::where('project_id', $project_id)->where('controller_id', $ca->controller->id)->orWhere('controller_id', 0)->orderBy('id')->get();
    $variables = App\Variable::where('project_id', $project_id)->whereIn('controller_id', [0, $ca->controller->id])->orderBy('id')->get();
    $variables = is_iterable($variables) ? $variables : [$variables];
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

    $combination_array = [];

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
    $rules = App\Rule::where('controlaction_id', $ca->id)->get();
    $rules = is_iterable($rules) ? $rules : [$rules];

    // Array to store the rules and the variables states of the rules
    $rules_variables_states = [];
    if (count($rules) > 0) {
        foreach($rules as $rule) {
            array_push($rules_variables_states, App\RulesVariablesStates::where('rule_id', $rule->id)->orderBy('rule_id')->orderBy('variable_id')->get());
        }
    }

    // BubbleSort to order the rules. For some reason, the sql "orderBy" is not working.
    if (count($rules_variables_states) > 0){
        for ($i = 0; $i < count($rules_variables_states)-1; $i++){
            for ($j = $i+1; $j < count($rules_variables_states); $j++){
                if ($rules_variables_states[$i][0]["rule_id"] > $rules_variables_states[$j][0]["rule_id"]){
                    $aux = $rules_variables_states[$i];
                    $rules_variables_states[$i] = $rules_variables_states[$j];
                    $rules_variables_states[$j] = $aux;
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
                    <div class="text legend-content"> The Control Action in this context is not hazardous (it is safe or indifferent)</div>
                </div>
                <div class="table-row">
                    <select class="legend-select" disabled="">
                        <option>Hazardous</option>
                    </select>
                    <div class="text legend-content"> The Control Action in this context is hazardous</div>
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

     <div id='filter-ca-{{$ca->id}}' class="context_table_filter">
        <div class="container">
            <div class="container-fluid" style="margin-top: 10px">
                <div class="table-row header-blue">
                    <div class="text center">Filter</div>
                </div>
                <div class="table-row">
                    <input type="checkbox" value="columnProvided-ca-{{$ca->id}}" name="check_columnProvided" checked>
                    <label>Control Action provided</label>
                </div>    
                <div class="table-row">
                    <input type="checkbox" value="columnNotProvided-ca-{{$ca->id}}" name="check_columnNotProvided" checked>
                    <label>Control Action not provided</label>
                </div>
                <div class="table-row">
                    <input type="checkbox" value="columnWrongOrder-ca-{{$ca->id}}" name="check_columnWrongOrder" checked>
                    <label>Wrong order of Control Action</label>
                </div>
                <div class="table-row">
                    <input type="checkbox" value="columnTooEarly-ca-{{$ca->id}}"  name="check_columnTooEarly" checked>
                    <label>Control Action provided too early</label>
                </div>  
                <div class="table-row">
                    <input type="checkbox" value="columnTooLate-ca-{{$ca->id}}" name="check_columnTooLate" checked>
                    <label>Control Action provided too late</label>
                </div>
                <div class="table-row">
                    <input type="checkbox" value="columnTooSoon-ca-{{$ca->id}}" name="check_columnTooSoon" checked>
                    <label>Control Action stopped too soon</label>
                </div>
                <div class="table-row">
                    <input type="checkbox" value="columnTooLong-ca-{{$ca->id}}"  name="check_columnTooLong" checked>
                    <label>Control Action applied too long</label>
                </div>  
            </div>    
        </div>    
    </div>    
    <!-- Add icon library -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    @if ($rows_number > 1)
        <button class="legend-button">SEE TABLE LEGEND</button> 
        <button class="context_table_filter-button"><i class="fa fa-filter"></i> FILTER</button>
        - This context table has <b>{{$rows_number}}</b> rows
    @else
        <button class="legend-button">SEE TABLE LEGEND</button> 
        <button class="context_table_filter-button"><i class="fa fa-filter"></i> FILTER</button>
        - This context table has <b>{{$rows_number}}</b> row
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

                <table class="context_table_style">

                    <tr class="table-row header">
                        <!--Div in blank for the number of the rows -->
                        <th class="number-contexttable">#</th>
      
                        @foreach ($variables as $variable)
                            <th  class="text">{{$variable->name}}</th>
                            <input type="hidden" id="varible-name-id-{{$variable->id}}" name="varible-name-id-{{$variable->id}}" value="{{$variable->name}}">
                        @endforeach
       
                        <th class="text" id="columnProvided-ca-{{$ca->id}}-header">Control Action provided</th>
                        <th class="text" id="columnNotProvided-ca-{{$ca->id}}-header">Control Action not provided</th>
                        <th class="text" id="columnWrongOrder-ca-{{$ca->id}}-header">Wrong order of Control Action</th>
                        <th class="text" id="columnTooEarly-ca-{{$ca->id}}-header">Control Action provided too early</th>
                        <th class="text" id="columnTooLate-ca-{{$ca->id}}-header">Control Action provided too late</th>
                        <th class="text" id="columnTooSoon-ca-{{$ca->id}}-header">Control Action stopped too soon</th>
                        <th class="text" id="columnTooLong-ca-{{$ca->id}}-header">Control Action applied too long</th>

                    </tr>

                    @while($total_loop > 0)
                    <?php
                        $columns = [];
                        $rule = [];
                        foreach($rules as $r) {
                            array_push($rule, "true");
                        }
                    ?>
                        <tr class="table-row">

                            <td class="number-contexttable">
                                <?php
                                    echo abs($rows_number - $total_loop + 1).".";
                                ?>
                            </td>

                            @for($i = 0; $i < count($allStates); $i++)
                                
                                <td class="text">
                                    {{$allStates[$i][$combination_array[$i]]}}<br/>
                                    <input type="hidden" id="name-state-id-{{$allStatesId[$i][$combination_array[$i]]}}" name="name-state-id-{{$allStatesId[$i][$combination_array[$i]]}}" value="{{$allStates[$i][$combination_array[$i]]}}">
                                    <input type="hidden" id="associated-variable-id-{{$allStatesId[$i][$combination_array[$i]]}}" name="associated-variable-id-{{$allStatesId[$i][$combination_array[$i]]}}" value="{{$allVariablesId[$i][$combination_array[$i]]}}">
                                </td>
                                <?php
                                    array_push($arr, $allStatesId[$i][$combination_array[$i]]);
                                    // Verifying if the rule fits
                                    if(count($rules_variables_states) > 0) {
                                        foreach($rules_variables_states as $key => $r) {                                        
                                            if (count($r) > $i) {      //aqui tinha erro prestar atenção                                   
                                                if($r[$i]->state_id == 0){                                            
                                                    if ($rule[$key] == "true"){
                                                        $rule[$key] = "true";
                                                        $columns[$key] = App\Rule::find($r[$i]->rule_id)->column;
                                                    }

                                                } else if ( ($allStates[$i][$combination_array[$i]] == App\State::find($r[$i]->state_id)->name) && ($rule[$key] == "true") ){
                                                    $rule[$key] = "true";
                                                    $columns[$key] = App\Rule::find($r[$i]->rule_id)->column;
                                                } else {
                                                    $rule[$key] = "false";
                                                    $columns[$key] = App\Rule::find($r[$i]->rule_id)->column;
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

                            

                            <!--<td class="text" id="rule-row-{{$total_loop}}" name="rule-row-{{$total_loop}}">!-->
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
                                $column_rules = array (
                                    "Provided" => "",
                                    "Not Provided" =>  "",
                                    "Provided too early" => "",
                                    "Provided too late" => "",
                                    "Wrong order" => "",
                                    "Stopped too soon" => "",
                                    "Applied too long" =>  ""
                                );
                                foreach ($rule as $key => $r) {
                                    if ($r == "true") {
                                        $thereAreRule = "true";
                                        $columns_that_rule_can_be_applied = explode(";", $columns[$key]);
                                        //print_r($columns_that_rule_can_be_applied);
                                        
                                        foreach($columns_that_rule_can_be_applied as $column_rule)
                                        {
                                            $column_name[$column_rule] = true;
                                            if(strcmp("", $column_rules[$column_rule]) == 0)
                                                $column_rules[$column_rule] = "<hr>";
                                            $column_rules[$column_rule] .= "R".($key+1)." ";
                                        }
                                        

                                    } else {
                                        $r[$key] = "false";
                                    }
                                }                       
                                $context_table = DB::select('SELECT * FROM context_tables WHERE controlaction_id = ? and ? like concat("%",context,"%") ORDER BY context', [$ca->id, $array_for_compare]);

                                $context_table = is_iterable($context_table) ? $context_table : [$context_table];

                                $context_table = (count($context_table) > 0) ? $context_table[0] : "";

                            ?>
                            <!--</td>!-->

                            <input type="hidden" id="all_states_{{$total_loop}}" name="all_states_{{$total_loop}}" value="{{$array_for_compare}}">

                            @if (App\ContextTable::where('controlaction_id', $ca->id)->count() > 0)
                                
                                <!-- Error fixed: Some rows of the Context Table were not properly recorded. We fixed the error verifing if every row is filled. -->
                                @if ($context_table != null)
                                    <!--Control Action Provided-->
                                    <td name="columnProvided-ca-{{$ca->id}}">
                                        @if ($thereAreRule == "true" && $column_name["Provided"] == true)
                                            <select  id="provided-ca-{{$ca->id}}-row-{{$total_loop}}" name="ca-provided-ca-{{$ca->id}}-row-{{$total_loop}}" disabled>
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
                                            
                                            <?php
                                                echo ($column_rules["Provided"]);
                                            ?>
                                    </td>
                                    <!--Control action not provided-->
                                    <td name="columnNotProvided-ca-{{$ca->id}}">
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

                                        <?php
                                            echo ($column_rules["Not Provided"]);
                                        ?>
                                    </td>
                                    <!-- Wrong time or order causes hazard-->
                                    <td name="columnWrongOrder-ca-{{$ca->id}}">
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

                                        <?php
                                            echo ($column_rules["Wrong order"]);
                                        ?>
                                    </td>
                                    <!--Control Action provided too early-->
                                   <td name="columnTooEarly-ca-{{$ca->id}}">
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

                                        <?php
                                            echo ($column_rules["Provided too early"]);
                                        ?>  
                                    </td>
                                    <!--Control Action provided too late-->
                                    <td name="columnTooLate-ca-{{$ca->id}}">
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

                                        <?php
                                            echo ($column_rules["Provided too late"]);
                                        ?>
                                    </td>
                                    <!--Control action stopped too soon-->
                                    <td name="columnTooSoon-ca-{{$ca->id}}">
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

                                        <?php
                                            echo ($column_rules["Stopped too soon"]);
                                        ?>
                                    </td>
                                    <!--Control Action applied too long-->
                                    <td name="columnTooLong-ca-{{$ca->id}}">
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

                                        <?php
                                            echo ($column_rules["Applied too long"]);
                                        ?>
                                    </td>
                                @else
                                <td name="columnProvided-ca-{{$ca->id}}">
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
                        
                                    <?php
                                        echo ($column_rules["Provided"]);
                                    ?>
                                </td> 

                                <!--Control action not provided-->
                                <td name="columnNotProvided-ca-{{$ca->id}}">
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

                                    <?php
                                        echo ($column_rules["Not Provided"]);
                                    ?>
                                </td>
                                <!--Wrong time or order causes hazard-->
                                <td name="columnWrongOrder-ca-{{$ca->id}}">
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

                                    <?php
                                        echo ($column_rules["Wrong order"]);
                                    ?>
                                </td>
                                <!--Control Action provided too early-->
                                <td name="columnTooEarly-ca-{{$ca->id}}">
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
                                    <?php
                                        echo ($column_rules["Provided too early"]);
                                    ?>
                                </td>
                                <!--Control Action provided too late-->
                                <td name="columnTooLate-ca-{{$ca->id}}">
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
                                    <?php
                                        echo ($column_rules["Provided too late"]);
                                    ?>
                                </td>
                                <!--Control action stopped too soon-->
                                <td name="columnTooSoon-ca-{{$ca->id}}">
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

                                    <?php
                                        echo ($column_rules["Stopped too soon"]);
                                    ?>
                                </td>
                                <!--Control Action applied too long-->
                                <td name="columnTooLong-ca-{{$ca->id}}">
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

                                    <?php
                                        echo ($column_rules["Applied too long"]);
                                    ?>
                                </td>

                                @endif
                            @else
                                <!--Control Action Provided-->
                                <td name="columnProvided-ca-{{$ca->id}}">
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
                                        
                                        <?php
                                            echo ($column_rules["Provided"]);
                                        ?>
                                        
                                </td>

                                <!--Control action not provided-->
                                <td name="columnNotProvided-ca-{{$ca->id}}">
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

                                    <?php
                                        echo ($column_rules["Not Provided"]);
                                    ?>
                                </td>
                                <!--Wrong time or order causes hazard-->
                                <td name="columnWrongOrder-ca-{{$ca->id}}">
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

                                    <?php
                                        echo ($column_rules["Wrong order"]);
                                    ?>
                                </td>
                                <!--Control Action provided too early-->
                                <td name="columnTooEarly-ca-{{$ca->id}}">
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

                                    <?php
                                        echo ($column_rules["Provided too early"]);
                                    ?>
                                </td>
                                <!--Control Action provided too late-->
                                <td name="columnTooLate-ca-{{$ca->id}}">
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

                                    <?php
                                        echo ($column_rules["Provided too late"]);
                                    ?>
                                </td>
                                <!--Control action stopped too soon-->
                                <td name="columnTooSoon-ca-{{$ca->id}}">
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

                                    <?php
                                        echo ($column_rules["Stopped too soon"]);
                                    ?>
                                </td>
                                <!--Control Action applied too long-->
                                <td name="columnTooLong-ca-{{$ca->id}}">
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

                                    <?php
                                        echo ($column_rules["Applied too long"]);
                                    ?>
                                </td>
                            @endif
                        </tr>
                    @endwhile
                </table>
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
