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
                @foreach (App\Variable::where('project_id', $project_id)->whereIn('controller_id', [0, $controller->id])->get() as $variable)
                    <div class="text">{{$variable->name}}</div>
                @endforeach
                <div class="content-uca">
                    <!-- Header to delete a rule -->
                </div>
            </div>

            @foreach (App\Rules::where('controlaction_id', $ca->id)->orderBy('id', 'asc')->select('index', 'column')->distinct()->get() as $rule_index)
                <div class="table-row rules-table rules-ca-{{$ca->id}}-rule-{{$rule_index->index}}">
                    <div class="text center">R{{$rule_index->index}}</div>
                    <div class="text center">
                        <?php
                            $name_of_the_columns = explode(";", $rule_index->column);
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
                    @foreach (App\Rules::where('index', $rule_index->index)->where('controlaction_id', $ca->id)->orderBy('variable_id', 'asc')->get() as $rule)
                        @if ($rule->state_id == 0)
                            <div class="text center">ANY</div>
                        @else
                            <div class="text center">{{App\State::find($rule->state_id)->name}}</div>
                        @endif
                    @endforeach
                    <div class="content-uca">
                        <form action="/deleterule" class="delete-form" data-delete="rules" method="POST">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <input type="hidden" name="controlaction_id" id="controlaction_id" value="{{$ca->id}}">
                            <input type="hidden" name="rule_index" id="rule_index" value="{{$rule_index->index}}">
                            <input type="image" src="{{ asset('images/trash.png') }}" alt="Delete" width="20" class="navbar__logo">
                        </form>
                    </div>
                </div>
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