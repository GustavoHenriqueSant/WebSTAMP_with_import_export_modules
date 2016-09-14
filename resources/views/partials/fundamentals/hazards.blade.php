<div class="substep__title">
    Hazards
</div>

<div class="substep__add" data-component="add-button" data-add="hazard">
    +
</div>

<div class="substep__content" id="hazards_content" data-accidents="{{$accidents}}">
    <ul class="substep__list">
        @foreach (App\Hazards::all() as $hazard)
            <li class="item">
                <div class="item__title">
                    H-{{$hazard->id}}: {{ $hazard->name }}
                </div>
                <div class="item__actions__action">
                    @if (isset($hazard->accidentshazards[0]))
                        [A-{{$hazard->accidentshazards[0]->accidents_id}}]
                    @else
                        [A-1]
                    @endif
                </div>
                <div class="item__actions">
                    <div class="item__title">
                        <img src="{{ asset('images/edit.ico') }}" alt="Edit" width="20" class="navbar__logo">
                    </div>
                    <div class="item__title">
                        <img src="{{ asset('images/delete.ico') }}" alt="Delete" width="20" class="navbar__logo">
                    </div>
                </div>
            </li>
        @endforeach
    </ul>
</div>
