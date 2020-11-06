<div class="substep__title">
    Losses&nbsp<i class="fa fa-question-circle" title="A loss involves something of value to stakeholders. Losses may include a loss of human life or human injury, property damage, environmental pollution, loss of mission, loss of reputation, loss or leak of sensitive information, or any other loss that is unacceptable to the stakeholders (STPA Handbook, p. 16)"></i>
</div>

<div class="substep__add" data-component="add-button" data-add="loss">
    +
</div>
<input type="hidden" id="project_type" value="{{$project_type}}"/>
<div class="substep__content">
    <ul class="substep__list">
        @foreach ($losses as $loss)
            <li class="item" id="loss-{{$loss->id}}">
                <div class="item__list">
                    <div class="item__title__textarea">
                        <label for="loss-description-{{$loss->id}}">L-{{$loss_map[$loss->id]}}:</label>
                        <textarea maxlength="500" class="responsive_textarea" rows="1" id="loss-description-{{$loss->id}}" disabled>{{ $loss->name }}</textarea>
                    </div>

                    <div class="item__actions">

                        <div id="default-menu-loss-{{$loss->id}}">
                                <div class="item__title">
                                    <input type="image" id="ediloss->id}}" name="{{$loss->id}}" src="{{ asset('images/edit.ico') }}" alt="Edit-loss" width="20" class="navbar__logo edit-btn">
                                </div>
                                 

                                <form action ="/deleteloss" method="POST" class="delete-form ajaxform" data-delete="loss">
                                    <div class="item__title">
                                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                                        <input id="project_id" name="project_id" type="hidden" value="1">
                                        <input id="loss_id" name="loss_id" type="hidden" value="{{$loss->id}}">
                                        <input type="image" src="{{ asset('images/trash.png') }}" alt="Delete" width="20" class="navbar__logo">
                                    </div>
                                </form>
                            </div>

                            <div id="edition-menu-loss-{{$loss->id}}" style="display: none;">
                                 <form action ="/editloss" method="POST" class="edit-form ajaxform" data-edit="loss">
                                    <div class="item__title">
                                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                                        <input id="project_id" name="project_id" type="hidden" value="1">
                                        <input id="loss_id" name="loss_id" type="hidden" value="{{$loss->id}}">
                                        <input type="image" id="save-loss-{{$loss->id}}" src="{{ asset('images/save.ico') }}" alt="Edit" width="20" class="navbar__logo">
                                    </div>
                                </form>
                                
                                <div class="item__title">
                                    <input type="image" id="cancel-edit-loss-{{$loss->id}}" name="{{$loss->id}}" src="{{ asset('images/delete.ico') }}" alt="Cancel-loss" width="20" class="navbar__logo cancel-edit-btn">
                                </div>
                            </div> 
                    </div>
                </div>
            </li>
        @endforeach
    </ul>
</div>
