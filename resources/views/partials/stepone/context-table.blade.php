<?php
    // Getting all variables
    $variables = App\Variable::where('project_id', 1)->where('controller_id', $ca->controller->id)->orWhere('controller_id', 0)->orderBy('id')->get();
    // Getting all States
    $states = [];
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

                <br/><center><button class="font-button"><img src="/images/save.ico" class="context-table-button" width="15"/> Save Context Table</button></center>
            </form>
        </div>
    </div>
</div>