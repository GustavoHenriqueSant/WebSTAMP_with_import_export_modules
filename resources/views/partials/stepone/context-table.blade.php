<?php
    // Getting all variables
    $variables = App\Variable::all();
    // Getting all States
    $states = App\State::all();
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

    // Select all rules associated with the selected control action
    $rule = App\Rules::where('controlaction_id', $ca->id)->get();
    // Get the number of rules
    $total_index = App\Rules::distinct()->select('index')->where('controlaction_id', $ca->id)->get();
    // Array to store the rules
    $rle = [];
    if (count($total_index) > 0) {
        foreach($total_index as $index) {
            array_push($rle, App\Rules::where('controlaction_id', $ca->id)->where('index', $index->index)->orderBy('index', 'asc')->orderBy('variable_id', 'asc')->get());
        }
    }


?>
<div class="substep__title">
    Context Table - {{$ca->name}}
</div>

<div class="substep__content">

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
                    <div class="table-row">

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
                                $divisor = 2 ** $multiple;
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

                            foreach ($rules as $key => $r) {
                                if ($r == "true" && count($r) > 0) {
                                    echo "R".($key+1)." ";
                                    $thereAreRule = "true";
                                } else {
                                    $r[$key] = "false";
                                }
                            }

                            $context_table = DB::select('SELECT * FROM context_tables WHERE controlaction_id = ? and ? like concat("%",context,"%")', [1, $array_for_compare]);
                            $context_table = (count($context_table) > 0) ? $context_table[0] : "";

                        ?>
                        </div>

                        <input type="hidden" id="all_states_{{$total_loop}}" name="all_states_{{$total_loop}}" value="{{$array_for_compare}}">

                        @if (App\ContextTable::where('controlaction_id', $ca->id)->count() > 0)
                            

                                <!--Control Action Provided-->
                                @if ($thereAreRule == "true")
                                    <select class="text" id="provided-row-{{$total_loop}}" name="ca-provided-row-{{$total_loop}}" disabled>
                                @else
                                    <select class="text" id="provided-row-{{$total_loop}}" name="ca-provided-row-{{$total_loop}}">
                                @endif
                                        <option value="null">-</option>
                                        @if ($thereAreRule == "true")
                                            <option value="true" selected>True</option>
                                        @else
                                            <option value="true">True</option>
                                        @endif
                                        <option value="false">False</option>
                                    </select>

                                <!--Control action not provided-->
                                <select class="text" id="notprovided-row-{{$total_loop}}" name="ca-not-provided-row-{{$total_loop}}">
                                    @if($context_table->ca_not_provided == "null")
                                        <option value="null" selected>-</option>
                                        <option value="true">True</option>
                                        <option value="false">False</option>
                                    @elseif($context_table->ca_not_provided == "true")
                                        <option value="null">-</option>
                                        <option value="true" selected>True</option>
                                        <option value="false">False</option>
                                    @else
                                        <option value="null">-</option>
                                        <option value="true">True</option>
                                        <option value="false" selected>False</option>
                                    @endif
                                </select>

                                <!--Wrong time or order causes hazard-->
                                <select class="text" id="wrongtime-row-{{$total_loop}}" name="wrongtime-row-{{$total_loop}}">
                                    @if($context_table->wrong_time_order == "null")
                                        <option value="null" selected>-</option>
                                        <option value="true">True</option>
                                        <option value="false">False</option>
                                    @elseif($context_table->wrong_time_order == "true")
                                        <option value="null">-</option>
                                        <option value="true" selected>True</option>
                                        <option value="false">False</option>
                                    @else
                                        <option value="null">-</option>
                                        <option value="true">True</option>
                                        <option value="false" selected>False</option>
                                    @endif
                                </select>

                                <!--Control Action provided too early-->
                                <select class="text" id="early-row-{{$total_loop}}" name="early-row-{{$total_loop}}">
                                    @if($context_table->ca_too_early == "null")
                                        <option value="null" selected>-</option>
                                        <option value="true">True</option>
                                        <option value="false">False</option>
                                    @elseif($context_table->ca_too_early == "true")
                                        <option value="null">-</option>
                                        <option value="true" selected>True</option>
                                        <option value="false">False</option>
                                    @else
                                        <option value="null">-</option>
                                        <option value="true">True</option>
                                        <option value="false" selected>False</option>
                                    @endif
                                </select>

                                <!--Control Action provided too late-->
                                <select class="text" id="late-row-{{$total_loop}}" name="late-row-{{$total_loop}}">
                                    @if($context_table->ca_too_late == "null")
                                        <option value="null" selected>-</option>
                                        <option value="true">True</option>
                                        <option value="false">False</option>
                                    @elseif($context_table->ca_too_late == "true")
                                        <option value="null">-</option>
                                        <option value="true" selected>True</option>
                                        <option value="false">False</option>
                                    @else
                                        <option value="null">-</option>
                                        <option value="true">True</option>
                                        <option value="false" selected>False</option>
                                    @endif
                                </select>
                                <!--Control action stopped too soon-->
                                <select class="text" id="soon-row-{{$total_loop}}" name="soon-row-{{$total_loop}}">
                                    @if($context_table->ca_too_soon == "null")
                                        <option value="null" selected>-</option>
                                        <option value="true">True</option>
                                        <option value="false">False</option>
                                    @elseif($context_table->ca_too_soon == "true")
                                        <option value="null">-</option>
                                        <option value="true" selected>True</option>
                                        <option value="false">False</option>
                                    @else
                                        <option value="null">-</option>
                                        <option value="true">True</option>
                                        <option value="false" selected>False</option>
                                    @endif
                                </select>
                                <!--Control Action applied too long-->
                                <select class="text" id="long-row-{{$total_loop}}" name="long-row-{{$total_loop}}">
                                    @if($context_table->ca_too_long == "null")
                                        <option value="null" selected>-</option>
                                        <option value="true">True</option>
                                        <option value="false">False</option>
                                    @elseif($context_table->ca_too_long == "true")
                                        <option value="null">-</option>
                                        <option value="true" selected>True</option>
                                        <option value="false">False</option>
                                    @else
                                        <option value="null">-</option>
                                        <option value="true">True</option>
                                        <option value="false" selected>False</option>
                                    @endif
                                </select>
                            
                        @else
                            <!--Control Action Provided-->
                        @if ($thereAreRule == "true")
                            <select class="text" id="provided-row-{{$total_loop}}" name="ca-provided-row-{{$total_loop}}" disabled>
                        @else
                            <select class="text" id="provided-row-{{$total_loop}}" name="ca-provided-row-{{$total_loop}}">
                        @endif
                                <option value="nada">-</option>
                                @if ($thereAreRule == "true")
                                    <option value="true" selected>True</option>
                                @else
                                    <option value="true">True</option>
                                @endif
                                <option value="false">False</option>
                            </select>

                            <!--Control action not provided-->
                            <select class="text" id="notprovided-row-{{$total_loop}}" name="ca-not-provided-row-{{$total_loop}}">
                                <option value="nada" selected>-</option>
                                <option value="true">True</option>
                                <option value="false">False</option>
                            </select>

                            <!--Wrong time or order causes hazard-->
                            <select class="text" id="wrongtime-row-{{$total_loop}}" name="wrongtime-row-{{$total_loop}}">
                                <option value="nada" selected>-</option>
                                <option value="true">True</option>
                                <option value="false">False</option>
                            </select>

                            <!--Control Action provided too early-->
                            <select class="text" id="early-row-{{$total_loop}}" name="early-row-{{$total_loop}}">
                                <option value="nada" selected>-</option>
                                <option value="true">True</option>
                                <option value="false">False</option>
                            </select>

                            <!--Control Action provided too late-->
                            <select class="text" id="late-row-{{$total_loop}}" name="late-row-{{$total_loop}}">
                                <option value="nada" selected>-</option>
                                <option value="true">True</option>
                                <option value="false">False</option>
                            </select>
                            <!--Control action stopped too soon-->
                            <select class="text" id="soon-row-{{$total_loop}}" name="soon-row-{{$total_loop}}">
                                <option value="nada" selected>-</option>
                                <option value="true">True</option>
                                <option value="false">False</option>
                            </select>
                            <!--Control Action applied too long-->
                            <select class="text" id="long-row-{{$total_loop}}" name="long-row-{{$total_loop}}">
                                <option value="nada" selected>-</option>
                                <option value="true">True</option>
                                <option value="false">False</option>
                            </select>

                        @endif
                    </div>
                @endwhile
                <center><button>Save</button></center>  
            </form>
        </div>
    </div>
</div>