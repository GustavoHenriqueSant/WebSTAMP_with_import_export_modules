<?php
    if (!isset($component_id)){
        $component_id = 0;
        $data_add = 'variable-0';
    } else {
        $data_add = 'variable-controller-'.$component_id;
    }
?>
<div class="substep__title">
    @if($component_id == 0)
        System Variables
    @else
        {{$component_name}} Variables (Process Model)
    @endif
</div>

<div class="substep__add" data-component="add-button" data-add="{{$data_add}}">
    +
</div>

@if($component_id > 0)
    <div class="substep__content variables-content" id={{$data_add}}>
@else
    <div class="substep__content" id={{$data_add}}>
@endif

    <ul class="substep__list">
        <span class="controller_variable">
            @foreach (App\Variable::where('controller_id', $component_id)->where('project_id', $project_id)->get() as $variable)
                <li class="item"  id="variable-{{$variable->id}}">
                    <div class="item__title">
                        <input type="text" class="item__input" id="variable-description-{{ $variable->id }}" value="{{ $variable->name }}" disabled>
                    </div>
                    <span class="states-associated">
                    @foreach(App\State::where('variable_id', $variable->id)->get() as $state)
                        <div class="item__actions__action" id="state-associated-{{$state->id}}">
                            <a href="javascript:;" class="item__delete__box" data-type="variable" data-index="{{$state->id}}">×</a> {{$state->name}}
                        </div>
                    @endforeach
                    </span>
                    <div class="item__actions__add" style="display: none;" id="state-variable-{{$variable->id}}" data-component="add-button" data-add="state-variable-{{$variable->id}}">
                        <input type="image" src="{{ asset('images/plus.png') }}" alt="Add State" width="13" class="navbar__logo">
                    </div>

                    <div class="item__actions">
                        <form action ="/editvariable" method="POST" class="edit-form ajaxform" data-edit="variable">
                            <div class="item__title">
                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                <input id="project_id" name="project_id" type="hidden" value="1">
                                <input id="variable_id" name="variable_id" type="hidden" value="{{$variable->id}}">
                                <input type="image" src="{{ asset('images/edit.ico') }}" alt="Edit" width="20" class="navbar__logo">
                            </div>
                        </form>
                        <form action ="/deletevariable" method="POST" class="delete-form ajaxform" data-delete="variable">
                            <div class="item__title">
                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                <input id="project_id" name="project_id" type="hidden" value="1">
                                <input id="variable_id" name="variable_id" type="hidden" value="{{$variable->id}}">
                                <input type="image" src="{{ asset('images/trash.png') }}" alt="Delete" width="20" class="navbar__logo">
                            </div>
                        </form>
                    </div>
                </li>
            @endforeach
        </span>

        @if($component_id > 0)
            @foreach (App\Variable::where('controller_id', 0)->where('project_id', $project_id)->get() as $variable)
                <li class="item variable-{{$variable->id}}">
                    <div class="item__title">
                        <input type="text" class="item__input variable-description-{{ $variable->id }}" value="{{ $variable->name }}" disabled>
                    </div>
                    <span class="states-associated">
                        @foreach(App\State::where('variable_id', $variable->id)->get() as $state)
                            <div class="item__actions__action state-associated-{{$state->id}}">
                                {{$state->name}}
                            </div>
                        @endforeach
                    </span>
                </li>
            @endforeach
        @endif
    </ul>
</div>
