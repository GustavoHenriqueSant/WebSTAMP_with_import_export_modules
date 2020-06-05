<div class="substep__title">
    Assumptions
</div>

<div class="substep__add" data-component="add-button" data-add="assumption">
    +
</div>

<div class="substep__content">
    <ul class="substep__list">
        @foreach (App\Assumptions::where('project_id', $project_id)->get() as $assumption)
            <li class="item" id="assumption-{{$assumption->id}}">
                <div class="item__title">
                    A-{{$assumptions_map[$assumption->id]}}:<br/> <textarea class="item__textarea" id="assumption-description-{{$assumption->id}}"  rows="5"  cols = "100" style="resize: none; height: auto;" disabled>{{$assumption->name}}</textarea>
                </div>
                <div class="item__actions">
                    <form action ="/editassumption" method="POST" class="edit-form ajaxform" data-edit="assumption">
                        <div class="item__title">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <input id="project_id" name="project_id" type="hidden" value="1">
                            <input id="assumption_id" name="assumption_id" type="hidden" value="{{$assumption->id}}">
                            <input type="image" src="{{ asset('images/edit.ico') }}" alt="Edit" width="20" class="navbar__logo">
                        </div>
                    </form>
                    <form action ="/deleteassumption" method="POST" class="delete-form ajaxform" data-delete="assumption">
                        <div class="item__title">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <input id="project_id" name="project_id" type="hidden" value="1">
                            <input id="assumption_id" name="assumption_id" type="hidden" value="{{$assumption->id}}">
                            <input type="image" src="{{ asset('images/trash.png') }}" alt="Delete" width="20" class="navbar__logo">
                        </div>
                    </form>
                </div>
            </li>
        @endforeach
    </ul>
</div>
