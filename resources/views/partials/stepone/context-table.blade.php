<?php
    // Getting all variables
    $variables = App\Variable::where('project_id', 1)->where('controller_id', $ca->controller->id)->orWhere('controller_id', 0)->orderBy('id')->get();
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

    /*  
     *  Create a new array ($allStates) containing all states of all variables
     *  Ex: Variable 1 (State 1, State 2) and Variable 2 (State 3 and State 4)
     *  Resulting array: array([0] => array(State 1, State 2), [1] => array(State 3, State 4))
     */

    for($i = 0; $i < count($variables); $i++) {
        $allStates[$variable_index] = [];
        $allStatesId[$variable_index] = [];
        for ($j = 0; $j < count($states); $j++) {
            if ($variables[$i]->id == $states[$j]->variable_id){    
                array_push($allStates[$variable_index], $states[$j]->name);
                array_push($allStatesId[$variable_index], $states[$j]->id);
            }
        }
        $variable_index++;
    }

    // The number of all loops (The total number of the context table rows)
    $total_loop = 1;
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

?>
<div class="substep__title">
    Context Table - {{$ca->name}}
</div>

<div class="substep__content">

    @if ($rows_number > 1)
        This context table has <b>{{$rows_number}}</b> rows
    @else
        This context table has <b>{{$rows_number}}</b> row
    @endif

    <div class="container">

        <div class="container-fluid" style="margin-top: 10px">

            <form action="/savecontexttable" method="POST" class="save-context-table">

                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <input type="hidden" id="controlaction_id" name="controlaction_id" value="{{$ca->id}}">
                <input type="hidden" id="total_rows" name="total_rows" value="{{$total_loop}}">

                <div class="table-row header">
                @foreach ($variables as $variable)
                    <div class="text">{{$variable->name}}</div>
                @endforeach
                <div class="text">Index Rule</div>
                <div class="text">Control Action provided</div>
                <div class="text">Control Action not provided</div>
                <div class="text">Wrong time/order of Control Action</div>
                <div class="text">Control Action provided too early</div>
                <div class="text">Control Action provided too late</div>
                <div class="text">Control Action stopped too soon</div>
                <div class="text">Control Action applied too long</div>
                </div>

                @while($total_loop > 0)
                <?php
                    $rules = [];
                    foreach($total_index as $index) {
                        array_push($rules, "true");
                    }
                ?>
                    <div class="table-row center">

                        @for($i = 0; $i < count($allStates); $i++)
                            
                            <div class="text">
                                {{$allStates[$i][$combination_array[$i]]}} <br/>
                            </div>
                            <?php
                                array_push($arr, $allStatesId[$i][$combination_array[$i]]);
                                // Verifying if the rule fits
                                if(count($rle) > 0) {
                                    foreach($rle as $key => $r) {
                                        if (count($r) > 0) {                                        
                                            if($r[$i]->state_id == 0){                                            
                                                if ($rules[$key] == "true")
                                                    $rules[$key] = "true";
                                            } else if ( ($allStates[$i][$combination_array[$i]] == App\State::find($r[$i]->state_id)->name) && ($rules[$key] == "true") ){
                                                $rules[$key] = "true";
                                            } else {
                                                $rules[$key] = "false";
                                            }
                                        }
                                    }
                                }
                            ?>
                        @endfor

                        <?php
                        $arr = json_encode($arr);
                            $loop++;
                            for ($i = 0; $i < count($combination_array); $i++) {
                                $multiple = (count($combination_array)-($i+1));
                                //echo count($combination_array)-($i+1);
                                //$divisor = ($multiple > 0 ) ? count($number_of_states) * $multiple : 1;//
                                //$divisor = 2 ** $multiple;
                                $divisor = $divisor_num[$i];
                                $resto = $loop % $divisor;
                                //echo "Multiplo: " . $multiple . "<br>Divisor: " . $divisor . "<br>Resto: " . $resto . "<br><br>";
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

                            foreach ($rules as $key => $r) {
                                //echo  $r;
                                if ($r == "true" && count($r) > 0) {
                                    echo "R".($key+1)." ";
                                    $thereAreRule = "true";
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
                            
                            @if ($context_table != null)
                                <!--Control Action Provided-->
                                @if ($thereAreRule == "true")
                                    <select class="text" id="provided-ca-{{$ca->id}}-row-{{$total_loop}}" name="ca-provided-ca-{{$ca->id}}-row-{{$total_loop}}" disabled>
                                @else
                                    <select class="text" id="provided-ca-{{$ca->id}}-row-{{$total_loop}}" name="ca-provided-ca-{{$ca->id}}-row-{{$total_loop}}">
                                @endif
                                        @if($context_table->ca_provided == "true" || $thereAreRule == "true")
                                            <option value="null">-</option>
                                            <option value="true" selected>Unsafe</option>
                                            <option value="false">Safe</option>
                                        @elseif($context_table->ca_provided == "null")
                                            <option value="null" selected>-</option>
                                            <option value="true">Unsafe</option>
                                            <option value="false">Safe</option>
                                        @else
                                            <option value="null">-</option>
                                            <option value="true">Unsafe</option>
                                            <option value="false" selected>Safe</option>
                                        @endif
                                    </select>

                                <!--Control action not provided-->
                                <select class="text" id="notprovided-ca-{{$ca->id}}-row-{{$total_loop}}" name="ca-not-provided-ca-{{$ca->id}}-row-{{$total_loop}}">
                                    @if($context_table->ca_not_provided == "null")
                                        <option value="null" selected>-</option>
                                        <option value="true">Unsafe</option>
                                        <option value="false">Safe</option>
                                    @elseif($context_table->ca_not_provided == "true")
                                        <option value="null">-</option>
                                        <option value="true" selected>Unsafe</option>
                                        <option value="false">Safe</option>
                                    @else
                                        <option value="null">-</option>
                                        <option value="true">Unsafe</option>
                                        <option value="false" selected>Safe</option>
                                    @endif
                                </select>

                                <!--Wrong time or order causes hazard-->
                                <select class="text" id="wrongtime-ca-{{$ca->id}}-row-{{$total_loop}}" name="wrongtime-ca-{{$ca->id}}-row-{{$total_loop}}">
                                    @if($context_table->wrong_time_order == "null")
                                        <option value="null" selected>-</option>
                                        <option value="true">Unsafe</option>
                                        <option value="false">Safe</option>
                                    @elseif($context_table->wrong_time_order == "true")
                                        <option value="null">-</option>
                                        <option value="true" selected>Unsafe</option>
                                        <option value="false">Safe</option>
                                    @else
                                        <option value="null">-</option>
                                        <option value="true">Unsafe</option>
                                        <option value="false" selected>Safe</option>
                                    @endif
                                </select>

                                <!--Control Action provided too early-->
                                <select class="text" id="early-ca-{{$ca->id}}-row-{{$total_loop}}" name="early-ca-{{$ca->id}}-row-{{$total_loop}}">
                                    @if($context_table->ca_too_early == "null")
                                        <option value="null" selected>-</option>
                                        <option value="true">Unsafe</option>
                                        <option value="false">Safe</option>
                                    @elseif($context_table->ca_too_early == "true")
                                        <option value="null">-</option>
                                        <option value="true" selected>Unsafe</option>
                                        <option value="false">Safe</option>
                                    @else
                                        <option value="null">-</option>
                                        <option value="true">Unsafe</option>
                                        <option value="false" selected>Safe</option>
                                    @endif
                                </select>

                                <!--Control Action provided too late-->
                                <select class="text" id="late-ca-{{$ca->id}}-row-{{$total_loop}}" name="late-ca-{{$ca->id}}-row-{{$total_loop}}">
                                    @if($context_table->ca_too_late == "null")
                                        <option value="null" selected>-</option>
                                        <option value="true">Unsafe</option>
                                        <option value="false">Safe</option>
                                    @elseif($context_table->ca_too_late == "true")
                                        <option value="null">-</option>
                                        <option value="true" selected>Unsafe</option>
                                        <option value="false">Safe</option>
                                    @else
                                        <option value="null">-</option>
                                        <option value="true">Unsafe</option>
                                        <option value="false" selected>Safe</option>
                                    @endif
                                </select>
                                <!--Control action stopped too soon-->
                                <select class="text" id="soon-ca-{{$ca->id}}-row-{{$total_loop}}" name="soon-ca-{{$ca->id}}-row-{{$total_loop}}">
                                    @if($context_table->ca_too_soon == "null")
                                        <option value="null" selected>-</option>
                                        <option value="true">Unsafe</option>
                                        <option value="false">Safe</option>
                                    @elseif($context_table->ca_too_soon == "true")
                                        <option value="null">-</option>
                                        <option value="true" selected>Unsafe</option>
                                        <option value="false">Safe</option>
                                    @else
                                        <option value="null">-</option>
                                        <option value="true">Unsafe</option>
                                        <option value="false" selected>Safe</option>
                                    @endif
                                </select>
                                <!--Control Action applied too long-->
                                <select class="text" id="long-ca-{{$ca->id}}-row-{{$total_loop}}" name="long-ca-{{$ca->id}}-row-{{$total_loop}}">
                                    @if($context_table->ca_too_long == "null")
                                        <option value="null" selected>-</option>
                                        <option value="true">Unsafe</option>
                                        <option value="false">Safe</option>
                                    @elseif($context_table->ca_too_long == "true")
                                        <option value="null">-</option>
                                        <option value="true" selected>Unsafe</option>
                                        <option value="false">Safe</option>
                                    @else
                                        <option value="null">-</option>
                                        <option value="true">Unsafe</option>
                                        <option value="false" selected>Safe</option>
                                    @endif
                                </select>
                            @else
                            <?php
                                $oi = App\ContextTable::where('controlaction_id', $ca->id)->get();
                                echo isset($context_table->ca_provided) ? $context_table->ca_provided : "Provided";
                                echo isset($context_table->ca_not_provided) ? $context_table->ca_not_provided : "Not Provided";
                                echo isset($context_table->wrong_time_order) ? $context_table->wrong_time_order : "Provided Time";
                                echo isset($context_table->ca_too_late) ? $context_table->ca_too_late : "Provided Late";
                                echo isset($context_table->ca_too_early) ? $context_table->ca_too_early : "Provided Early";
                                echo isset($context_table->ca_too_soon) ? $context_table->ca_too_soon : "Provided Soon";
                                echo isset($context_table->ca_too_long) ? $context_table->ca_too_long : "Provided Long";
                            ?>
                                Deu erro aqui.
                            @endif
                            
                        @else
                            <!--Control Action Provided-->
                        @if ($thereAreRule == "true")
                            <select class="text" id="provided-ca-{{$ca->id}}-row-{{$total_loop}}" name="ca-provided-ca-{{$ca->id}}-row-{{$total_loop}}" disabled>
                        @else
                            <select class="text" id="provided-ca-{{$ca->id}}-row-{{$total_loop}}" name="ca-provided-ca-{{$ca->id}}-row-{{$total_loop}}">
                        @endif
                                <option value="null">-</option>
                                @if ($thereAreRule == "true")
                                    <option value="true" selected>Unsafe</option>
                                @else
                                    <option value="true">Unsafe</option>
                                @endif
                                <option value="false">Safe</option>
                            </select>

                            <!--Control action not provided-->
                            <select class="text" id="notprovided-ca-{{$ca->id}}-row-{{$total_loop}}" name="ca-not-provided-ca-{{$ca->id}}-row-{{$total_loop}}">
                                <option value="null" selected>-</option>
                                <option value="true">Unsafe</option>
                                <option value="false">Safe</option>
                            </select>

                            <!--Wrong time or order causes hazard-->
                            <select class="text" id="wrongtime-ca-{{$ca->id}}-row-{{$total_loop}}" name="wrongtime-ca-{{$ca->id}}-row-{{$total_loop}}">
                                <option value="null" selected>-</option>
                                <option value="true">Unsafe</option>
                                <option value="false">Safe</option>
                            </select>

                            <!--Control Action provided too early-->
                            <select class="text" id="early-ca-{{$ca->id}}-row-{{$total_loop}}" name="early-ca-{{$ca->id}}-row-{{$total_loop}}">
                                <option value="null" selected>-</option>
                                <option value="true">Unsafe</option>
                                <option value="false">Safe</option>
                            </select>

                            <!--Control Action provided too late-->
                            <select class="text" id="late-ca-{{$ca->id}}-row-{{$total_loop}}" name="late-ca-{{$ca->id}}-row-{{$total_loop}}">
                                <option value="null" selected>-</option>
                                <option value="true">Unsafe</option>
                                <option value="false">Safe</option>
                            </select>
                            <!--Control action stopped too soon-->
                            <select class="text" id="soon-ca-{{$ca->id}}-row-{{$total_loop}}" name="soon-ca-{{$ca->id}}-row-{{$total_loop}}">
                                <option value="null" selected>-</option>
                                <option value="true">Unsafe</option>
                                <option value="false">Safe</option>
                            </select>
                            <!--Control Action applied too long-->
                            <select class="text" id="long-ca-{{$ca->id}}-row-{{$total_loop}}" name="long-ca-{{$ca->id}}-row-{{$total_loop}}">
                                <option value="null" selected>-</option>
                                <option value="true">Unsafe</option>
                                <option value="false">Safe</option>
                            </select>

                        @endif
                    </div>
                @endwhile
                <br/><center><button class="font-button"><img src="/images/save.ico" class="context-table-button" width="15"/> Save Context Table</button></center>
            </form>
        </div>
    </div>
</div>