<div class="substep__title">
    Add new Rule
</div>

<div class="substep__content">

    <div class="container">

        @foreach (App\Variable::all() as $variable)
            <div class="grid-2" align="center"><b>{{$variable->name}}</b></div>
        @endforeach

        @foreach (App\Variable::all() as $variable)
            <select id="variable_id" class="grid-2">
                @foreach (App\State::where('variable_id', $variable->id)->get() as $state)
                    <option value="{{$state->id}}">{{$state->name}}</div>
                @endforeach
            </select>
        @endforeach
        

    </div>

</div>