<div class="substep__title">
    Losses
</div>

<div class="substep__add" data-component="add-button" data-add="loss">
    +
</div>
<input type="hidden" id="project_type" value="{{$project_type}}"/>
<div class="substep__content">
    <ul class="substep__list">
        @foreach ($losses as $loss)
            <li class="item" id="loss-{{$loss->id}}">
                <div class="item__title">
                    L-{{$loss_map[$loss->id]}}: <input type="text" class="item__input" id="loss-description-{{$loss->id}}" value="{{ $loss->name }}" disabled>
                </div>
                <div class="item__actions">
                    <form action ="/editloss" method="POST" class="edit-form ajaxform" data-edit="loss">
                        <div class="item__title">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <input id="project_id" name="project_id" type="hidden" value="{{$project_id}}">
                            <input id="loss_id" name="loss_id" type="hidden" value="{{$loss->id}}">
                            <input type="image" src="{{ asset('images/edit.ico') }}" alt="Edit" width="20" class="navbar__logo">
                        </div>
                    </form>
                    <form action ="/deleteloss" method="POST" class="delete-form ajaxform" data-delete="loss">
                        <div class="item__title">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <input id="project_id" name="project_id" type="hidden" value="{{$project_id}}">
                            <input id="loss_id" name="loss_id" type="hidden" value="{{$loss->id}}">
                            <input type="image" src="{{ asset('images/trash.png') }}" alt="Delete" width="20" class="navbar__logo">
                        </div>
                    </form>
                </div>
            </li>
        @endforeach
    </ul>
</div>
