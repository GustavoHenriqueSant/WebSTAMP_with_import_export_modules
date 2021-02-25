<div class="substep__title">
    System-level Hazards&nbsp<i class="fa fa-question-circle" title="Definition of Hazard: A hazard is a system state or set of conditions that, together with a particular set of worst-case environmental conditions, will lead to a loss. (STPA Handbook, p. 17)

Definition of System: A system is a set of components that act together as a whole to achieve some common goal, objective, or end. A system may contain subsystems and may also be part of a larger system. (STPA Handbook, p. 17)"></i>
</div>

<div class="substep__add" data-component="add-button" data-add="hazard">
    +
</div>

<div class="substep__content" id="hazards_content" data-losses="{{$losses}}">
    <ul class="substep__list">
        @foreach (App\Hazards::where('project_id', $project_id)->orderBy('id')->get() as $hazard)

            <li class="item" id="hazard-{{$hazard->id}}">

                
                <div class="item__list">
                    <ul class="substep__itens">
                        <li class="step1_itens">

                             <div class="item__title__textarea">
                                <label for="hazard-description-{{$hazard->id}}">H-{{$hazard_map[$hazard->id]}}:</label>
                                <textarea maxlength="500" class="responsive_textarea" rows="1" id="hazard-description-{{$hazard->id}}" disabled>{{$hazard->name}}</textarea>
                            </div>

                            <div class="item__actions">

                                <div id="default-menu-hazard-{{$hazard->id}}">
                                    <div class="item__title">
                                        <input type="image" id="edit-hazard-{{$hazard->id}}" name="{{$hazard->id}}" src="{{ asset('images/edit.ico') }}" alt="Edit-hazard" width="20" class="navbar__logo edit-btn">
                                    </div>
                                     

                                    <form action ="/deletehazard" method="POST" class="delete-form ajaxform" data-delete="hazard">
                                        <div class="item__title">
                                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                                            <input id="project_id" name="project_id" type="hidden" value="1">
                                            <input id="hazard_id" name="hazard_id" type="hidden" value="{{$hazard->id}}">
                                            <input type="image" src="{{ asset('images/trash.png') }}" alt="Delete" width="20" class="navbar__logo">
                                        </div>
                                    </form>
                                </div>

                                <div id="edition-menu-hazard-{{$hazard->id}}" style="display: none;">
                                     <form action ="/edithazard" method="POST" class="edit-form ajaxform" data-edit="hazard">
                                        <div class="item__title">
                                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                                            <input id="project_id" name="project_id" type="hidden" value="1">
                                            <input id="hazard_id" name="hazard_id" type="hidden" value="{{$hazard->id}}">
                                            <input type="image" id="save-hazard-{{$hazard->id}}" src="{{ asset('images/save.ico') }}" alt="Edit" width="20" class="navbar__logo">
                                        </div>
                                    </form>
                                    
                                    <div class="item__title">
                                        <input type="image" id="cancel-edit-hazard-{{$hazard->id}}" name="{{$hazard->id}}" src="{{ asset('images/delete.ico') }}" alt="Cancel-hazard" width="20" class="navbar__logo cancel-edit-btn">
                                    </div>
                                     
                                </div> 
                            </div>
                        </li>
                        <li class="step1_itens">
                            <div id="hazard_loss_association-{{$hazard->id}}" hidden="true">
                                <label id="label_hazard-{{$hazard->id}}" class="hidden">H-{{$hazard_map[$hazard->id]}}:</label>
                                <select id="hazard_loss-{{$hazard->id}}" name="hazard_loss" class="select_from_form_ssc" multiple required title="" size="3">     
                                </select>
                            </div>
                            <div id="hazard_{{$hazard->id}}_losses" style="margin: 0 0 15px 0;">
                                <?php $associated_losses = array(); ?>
                                @foreach(App\LossesHazards::where('hazard_id', $hazard->id)->get() as $losseshazards)
                                    <?php array_push($associated_losses, $losseshazards->loss_id); ?>

                                    <a class="hazard_loss_association" id="hazard_loss_{{$losseshazards->hazard_id}}_{{$losseshazards->loss_id}}">
                                        [L-{{$loss_map[$losseshazards->loss_id]}}]</a>&nbsp
                                @endforeach

                                 <?php
                                    $ids = ""; 
                                    foreach ($associated_losses as $index => $id) {
                                        if($index != count($associated_losses) - 1)
                                            $ids .= $id.",";
                                        else
                                            $ids .= $id;
                                    }
                                ?>
                   
                            </div>

                            <input hidden id="hazard_{{$hazard->id}}_losses_associated" value= <?php echo($ids); ?>>

                         </li>
                     </ul>
                </div> 
            </li>
        @endforeach
    </ul>
</div>
