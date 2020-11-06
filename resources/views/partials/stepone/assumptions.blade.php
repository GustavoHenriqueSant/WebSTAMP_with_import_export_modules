<div class="substep__title">
    Assumptions&nbsp<i class="fa fa-question-circle" title=""></i>
</div>

<div class="substep__add" data-component="add-button" data-add="assumption">
    +
</div>

<div class="substep__content">
    <ul class="substep__list">
        @foreach (App\Assumptions::where('project_id', $project_id)->get() as $assumption)
            <li class="item" id="assumption-{{$assumption->id}}">
                <div class="item__list">
                    <div class="item__title__textarea">
                        <label for="assumption-description-{{$assumption->id}}">A-{{$assumptions_map[$assumption->id]}}:</label>
                        <textarea maxlength="500" class="responsive_textarea" rows="1" id="assumption-description-{{$assumption->id}}" disabled>{{$assumption->name}}</textarea>
                    </div>
                    <div class="item__actions">

                        <div id="default-menu-assumption-{{$assumption->id}}">
                            <div class="item__title">
                                <input type="image" id="edit-assumption-{{$assumption->id}}" name="{{$assumption->id}}" src="{{ asset('images/edit.ico') }}" alt="Edit-assumption" width="20" class="navbar__logo edit-btn">
                            </div>
                             

                            <form action ="/deleteassumption" method="POST" class="delete-form ajaxform" data-delete="assumption">
                                <div class="item__title">
                                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                                    <input id="project_id" name="project_id" type="hidden" value="1">
                                    <input id="assumption_id" name="assumption_id" type="hidden" value="{{$assumption->id}}">
                                    <input type="image" src="{{ asset('images/trash.png') }}" alt="Delete" width="20" class="navbar__logo">
                                </div>
                            </form>
                        </div>

                        <div id="edition-menu-assumption-{{$assumption->id}}" style="display: none;">
                             <form action ="/editassumption" method="POST" class="edit-form ajaxform" data-edit="assumption">
                                <div class="item__title">
                                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                                    <input id="project_id" name="project_id" type="hidden" value="1">
                                    <input id="assumption_id" name="assumption_id" type="hidden" value="{{$assumption->id}}">
                                    <input type="image" id="save-assumption-{{$assumption->id}}" src="{{ asset('images/save.ico') }}" alt="Edit" width="20" class="navbar__logo">
                                </div>
                            </form>
                            
                            <div class="item__title">
                                <input type="image" id="cancel-edit-assumption-{{$assumption->id}}" name="{{$assumption->id}}" src="{{ asset('images/delete.ico') }}" alt="Cancel-assumption" width="20" class="navbar__logo cancel-edit-btn">
                            </div>
                             
                        </div> 
                    </div>
                </div>
            </li>
        @endforeach
    </ul>
</div>
