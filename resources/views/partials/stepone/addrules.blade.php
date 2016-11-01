<div class="substep__title">
    Add new Rule - {{$ca->name}}
</div>

<div class="substep__content">

    <div class="container-fluid" style="margin-top: 10px">


        <div class="table-row header">
            @foreach (App\Variable::all() as $variable)
                @if ($variable->name != "Default")
                <div class="text">{{$variable->name}}</div>
                @endif
            @endforeach
        </div>

        <form action="/addrule" method="POST" class="add-new-rule">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <input type="hidden" id="controlaction_id" name="controlaction_id" value="{{$ca->id}}">
            <div class="table-row">
                @foreach (App\Variable::all() as $variable)
                    @if ($variable->name != "Default")
                    <select id="variable_id_{{$variable->id}}" name="variable_id_{{$variable->id}}" class="text">
                        <option value="0" name="ANY">ANY</option>
                        @foreach (App\State::where('variable_id', $variable->id)->get() as $state)
                            <option value="{{$state->id}}" name="{{$state->name}}">{{$state->name}}</option>
                        @endforeach
                    </select>
                    @endif
                @endforeach
            </div>
            </br><center><button>Add new Rule</button></center>
        </form>
    </div>

    
</div>