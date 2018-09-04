<div class="substep__title">
    Hazards
</div>

<div class="substep__add" data-component="add-button" data-add="hazard">
    +
</div>

<div class="substep__content" id="hazards_content" data-accidents="{{$accidents}}">
    <ul class="substep__list">
        @foreach (App\Hazards::where('project_id', $project_id)->get() as $hazard)
            <li class="item" id="hazard-{{$hazard->id}}">
                <div class="item__title">
                    H-{{$hazard_map[$hazard->id]}}: <input type="text" class="item__input" id="hazard-description-{{$hazard->id}}" value="{{ $hazard->name }}" disabled>
                </div>
                @foreach($hazard->accidentshazards as $accidentshazards)
                    <div class="item__actions__action" id="accident-associated-{{$accidentshazards->id}}">
                        @if($project_type == "Safety")
                        <a href="javascript:;" class="item__delete__box" data-type="hazard" data-index="{{$accidentshazards->id}}">×</a> [A-{{$accident_map[$accidentshazards->accidents_id]}}]
                    @else
                       <a href="javascript:;" class="item__delete__box" data-type="hazard" data-index="{{$accidentshazards->id}}">×</a> [L-{{$accident_map[$accidentshazards->accidents_id]}}]
                    @endif
                    </div>
                @endforeach
                <div class="item__actions">
                    <form action ="/edithazard" method="POST" class="edit-form ajaxform" data-edit="hazard">
                        <div class="item__title">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <input id="project_id" name="project_id" type="hidden" value="1">
                            <input id="hazard_id" name="hazard_id" type="hidden" value="{{$hazard->id}}">
                            <input type="image" src="{{ asset('images/edit.ico') }}" alt="Edit" width="20" class="navbar__logo">
                        </div>
                    </form>
                    <form action ="/deletehazard" method="POST" class="delete-form ajaxform" data-delete="hazard">
                        <div class="item__title">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <input id="project_id" name="project_id" type="hidden" value="1">
                            <input id="hazard_id" name="hazard_id" type="hidden" value="{{$hazard->id}}">
                            <input type="image" src="{{ asset('images/trash.png') }}" alt="Delete" width="20" class="navbar__logo">
                        </div>
                    </form>
                </div>
            </li>
        @endforeach
    </ul>
</div>
