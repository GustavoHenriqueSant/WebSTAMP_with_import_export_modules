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
                <div class="text">
                    <!-- Header to delete a rule -->
                </div>
            </div>

            @foreach (App\Rules::where('controlaction_id', $ca->id)->orderBy('id', 'asc')->select('index')->distinct()->get() as $rule_index)
                <div class="table-row rules-table rules-ca-{{$ca->id}}-rule-{{$rule_index->index}}">
                    <div class="text center">R{{$rule_index->index}}</div>
                    @foreach (App\Rules::where('index', $rule_index->index)->where('controlaction_id', $ca->id)->orderBy('variable_id', 'asc')->get() as $rule)
                        @if ($rule->state_id == 0)
                            <div class="text center">ANY</div>
                        @else
                            <div class="text center">{{App\State::find($rule->state_id)->name}}</div>
                        @endif
                    @endforeach
                    <div class="text center">
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

</div>