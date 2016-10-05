<div class="substep__title">
    Hazards
</div>

<div class="substep__add" data-component="add-button" data-add="hazard">
    +
</div>

<div class="substep__content" id="hazards_content" data-accidents="{{$accidents}}">
    <ul class="substep__list">
        @foreach (App\Hazards::all() as $hazard)
            <li class="item" id="hazard-{{$hazard->id}}">
                <div class="item__title">
                    H-{{$hazard->id}}: {{ $hazard->name }}
                </div>
                <div class="item__actions__action">
                    @foreach($hazard->accidentshazards as $accidentshazards)
                        @if (isset($accidentshazards))
                            [A-{{$accidentshazards->accidents_id}}]
                        @else
                            [A-1]
                        @endif
                    @endforeach
                </div>
                <div class="item__actions">
                    <div class="item__title">
                        <img src="{{ asset('images/edit.ico') }}" alt="Edit" width="20" class="navbar__logo">
                    </div>
                    <form action ="/deletehazard" method="POST" class="delete-form ajaxform" data-delete="hazard">
                        <div class="item__title">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <input id="project_id" name="project_id" type="hidden" value="1">
                            <input id="hazard_id" name="hazard_id" type="hidden" value="{{$hazard->id}}">
                            <input type="image" src="{{ asset('images/delete.ico') }}" alt="Delete" width="20" class="navbar__logo">
                        </div>
                    </form>
                </div>
            </li>
        @endforeach
    </ul>
</div>
