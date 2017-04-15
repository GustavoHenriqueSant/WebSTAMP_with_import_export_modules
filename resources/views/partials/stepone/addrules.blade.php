<div class="substep__title">
    Add new Rule - {{$ca->name}}
</div>

<div class="substep__content">

    <div class="container-fluid" style="margin-top: 10px">


        <div class="table-row header">
            @foreach (App\Variable::where('project_id', 1)->where('controller_id', $ca->controller->id)->orWhere('controller_id', 0)->get() as $variable)
                @if ($variable->name != "Default")
                <div class="text">{{$variable->name}}</div>
                @endif
            @endforeach
        </div>

        <form action="/addrule" method="POST" class="add-new-rule">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <input type="hidden" id="controlaction_id" name="controlaction_id" value="{{$ca->id}}">
            <div class="table-row">
                @foreach (App\Variable::where('project_id', 1)->where('controller_id', $ca->controller->id)->orWhere('controller_id', 0)->get() as $variable)
                    @if ($variable->name != "Default")
                    <select id="variable_id_{{$variable->id}}" name="variable_id_{{$variable->id}}" class="text">
                        <option value="{{$variable->id}}-0" name="ANY">ANY</option>
                        @foreach (App\State::where('variable_id', $variable->id)->get() as $state)
                            <option value="{{$variable->id}}-{{$state->id}}" name="{{$state->name}}">{{$state->name}}</option>
                        @endforeach
                    </select>
                    @endif
                @endforeach
            </div>
            </br><center><button class="font-button"><img src="/images/plus.png" class="steptwo-button" width="15"/> Add new rule</button></center>
            <input type="hidden" name="uca-associated-{{$ca->id}}" id="uca-associated-{{$ca->id}}" value="{{$ca->controller->name}} provides {{$ca->name}} when"/>
        </form>
    </div>

    
</div>