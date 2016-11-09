<div class="substep__title">
    Unsafe Control Actions and Safety Constraints associated - {{$ca->name}}
</div>

<div class="substep__content">

    <div class="container">

        <div class="container-fluid" style="margin-top: 10px">

        <div class="table-row header">
            <div class="text">Unsafe Control Actions</div>
            <div class="text">Safety Constraint</div>
        </div>

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

        </div>     

    </div>

</div>