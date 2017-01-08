<div class="substep__title">
    Rules - {{$ca->name}}
</div>

<div class="substep__content">

    <div class="container">

        <div class="container-fluid control-action-{{$ca->id}}" style="margin-top: 10px">

            <div class="table-row header">
                <div class="text">Rule Index</div>
                @foreach (App\Variable::where("project_id", 1)->get() as $variable)
                    <div class="text">{{$variable->name}}</div>
                @endforeach
            </div>

            @foreach (App\Rules::where('controlaction_id', $ca->id)->select('index')->distinct()->get() as $rule_index)
                <div class="table-row rules-ca-{{$ca->id}}">
                    <div class="text">R{{$rule_index->index}}</div>
                    @foreach (App\Rules::where('index', $rule_index->index)->where('controlaction_id', $ca->id)->orderBy('variable_id', 'asc')->get() as $rule)
                        @if ($rule->state_id == 0)
                            <div class="text">ANY</div>
                        @else
                            <div class="text">{{App\State::find($rule->state_id)->name}}</div>
                        @endif
                    @endforeach
                </div>
            @endforeach 

        </div>     

    </div>

</div>