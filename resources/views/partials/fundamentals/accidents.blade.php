<div class="substep__title">
    @if($project_type == "Safety")
        Accidents
    @else
        Unacceptable Losses
    @endif
</div>

<div class="substep__add" data-component="add-button" data-add="accident">
    +
</div>
<input type="hidden" id="project_type" value="{{$project_type}}"/>
<div class="substep__content">
    <ul class="substep__list">
        @foreach ($accidents as $accident)
            <li class="item" id="accident-{{$accident->id}}">
                <div class="item__title">
                    @if($project_type == "Safety")
                        A-{{$accident_map[$accident->id]}}: <input type="text" class="item__input" id="accident-description-{{$accident->id}}" value="{{ $accident->name }}" disabled>
                    @else
                        L-{{$accident_map[$accident->id]}}: <input type="text" class="item__input" id="accident-description-{{$accident->id}}" value="{{ $accident->name }}" disabled>
                    @endif
                </div>
                <div class="item__actions">
                    <form action ="/editaccident" method="POST" class="edit-form ajaxform" data-edit="accident">
                        <div class="item__title">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <input id="project_id" name="project_id" type="hidden" value="{{$project_id}}">
                            <input id="accident_id" name="accident_id" type="hidden" value="{{$accident->id}}">
                            <input type="image" src="{{ asset('images/edit.ico') }}" alt="Edit" width="20" class="navbar__logo">
                        </div>
                    </form>
                    <form action ="/deleteaccident" method="POST" class="delete-form ajaxform" data-delete="accident">
                        <div class="item__title">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <input id="project_id" name="project_id" type="hidden" value="{{$project_id}}">
                            <input id="accident_id" name="accident_id" type="hidden" value="{{$accident->id}}">
                            <input type="image" src="{{ asset('images/trash.png') }}" alt="Delete" width="20" class="navbar__logo">
                        </div>
                    </form>
                </div>
            </li>
        @endforeach
    </ul>
</div>
