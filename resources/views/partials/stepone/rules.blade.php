<div class="substep__title">
    Rule
</div>

<div class="substep__content">

    <div class="container">

        <div class="container-fluid" style="margin-top: 10px">

        <div class="table-row header">
        <div class="text">Rule Index</div>
            @foreach (App\Variable::all() as $variable)
                <div class="text">{{$variable->name}}</div>
            @endforeach
        </div>

        @foreach (App\Rules::select('index')->distinct()->get() as $rule_index)
        <div class="table-row">
            <div class="text">R{{$rule_index->index}}</div>
            @foreach (App\Rules::where('index', $rule_index->index)->get() as $rule)
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