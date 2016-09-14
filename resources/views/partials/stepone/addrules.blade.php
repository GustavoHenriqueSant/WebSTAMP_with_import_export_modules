<div class="substep__title">
    Add new Rule
</div>

<div class="substep__content">

    <div class="container-fluid" style="margin-top: 10px">


        <div class="table-row header">
            @foreach (App\Variable::all() as $variable)
                <div class="text">{{$variable->name}}</div>
            @endforeach
        </div>

        <div class="table-row">
            @foreach (App\Variable::all() as $variable)
                <select id="variable_id" class="text">
                    <option value="0">ANY</option>
                    @foreach (App\State::where('variable_id', $variable->id)->get() as $state)
                        <option value="{{$state->id}}">{{$state->name}}</option>
                    @endforeach
                </select>
            @endforeach
        </div>
    </div>
</div>