@extends('layouts.master')

@section('content')

<div class="substep substep--project" id="project">
    <div class="substep__title">
        Projects
    </div>

    <div class="substep__add" id="add-new-project">
        +
    </div>

    <div class="substep__content">
        <ul class="substep__list">
            @foreach (App\Team::where('user_id', Auth::user()->id)->get() as $team)
                @foreach (App\Project::where('id', $team->project_id)->get() as $project)
                    <li class="item" id="project-{{$project->id}}">
                        <div class="item__title">
                            {{$project->name}}

                        </div>
                        <div class="item__actions">
                            <form action ="{{$project->URL}}/stepone" method="POST" class="edit-form ajaxform">
                                <div class="item__title">
                                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                                    <input id="project_id" name="project_id" type="hidden" value="{{$project->id}}">
                                    <input type="submit" class="add-button" value="Open project"></input>
                                    <!-- <button>Selecionar este Projeto</button> -->
                                </div>
                            </form>
                            <form action ="/editproject" method="POST" class="editing-form ajaxform">
                                <div class="item__title">
                                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                                    <input id="project_id" name="project_id" type="hidden" value="{{$project->id}}">
                                    <input id="project_name" name="project_name" type="hidden" value="{{$project->name}}">
                                    <input id="project_description" name="project_description" type="hidden" value="{{$project->description}}">
                                    <input type="submit" class="edit-button" value="Edit project information"></input>
                                    <!-- <button>Editar este Projeto</button> -->
                                </div>
                            </form>
                            <form action ="/deleteproject" method="POST" class="deleting-form ajaxform">
                                <div class="item__title">
                                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                                    <input id="project_id" name="project_id" type="hidden" value="{{$project->id}}">
                                    <input type="submit" class="delete-button" value="Delete the entire project"></input>
                                    <!-- <button>Deletar este Projeto</button> -->
                                </div>
                            </form>
                        </div>
                    </li>
                @endforeach
            @endforeach
        </ul>
    </div>
    
</div>        

<div id="add-project" style="display: none;">
    <form action="/addproject" class="adding-project" method="POST">
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <div class="vex-dialog-form garamond">
            <div class="center">
                <h3>Add new Project</h3>
            </div>
            <hr/>
            <div>
                <label class="bold">Project Name: </label>
                <input type="text" id="name" class="information-input garamond" placeholder="Insert the Project Name" />
            </div>

            <div>
                <label class="bold">Project Description: </label>
                <textarea class="information-input garamond" id="description" placeholder="Insert a brief Description of the project"></textarea>
            </div>

            <div>
                <label class="bold">Type </label>
                <select class="information-input garamond" id="type">
                    <option value="Safety">Safety</option>
                    <option value="Security">Safety and Security</option>
                </select>
            </div>

            <div>
                <label class="bold">Share with: </label>
                <input type="hidden" id="user-email" value="{{Auth::user()->email}}"/>
                <input type="text" id="shared" class="information-input garamond" placeholder="Enter one or more people by their e-mail (separated by semicolon)" />
            </div>
        </div>
        <div class="center-button">
                <button class="vex-dialog-button-primary vex-dialog-button vex-first">Add</button>
                <!--<button class="vex-dialog-button-secondary vex-dialog-button vex-last">Cancel</button>-->
            </div>
    </form>
</div>

<div id="edit-project" style="display: none;">
    <form action="/editproject" class="editing-project" method="POST">
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <div class="vex-dialog-form garamond">
            <div class="center">
                <h3>Editing a Project</h3>
            </div>
            <hr/>
            <div>
                <label class="bold">Project Name: </label>
                <input type="text" id="edit-name" class="information-input garamond" placeholder="Insert the Project Name" />
            </div>

            <div>
                <label class="bold">Project Description: </label>
                <textarea class="information-input garamond" id="edit-description" placeholder="Insert a brief Description of the project"></textarea>
            </div>
            <div>
                <label class="bold">Share with: </label>
                <input type="hidden" id="user-email" value="{{Auth::user()->email}}"/>
                <input type="text" id="edit-shared" class="information-input garamond" placeholder="Enter one or more people by their e-mail (separated by semicolon)" />
            </div>
            <input type="hidden" id="edit-id" />
        </div>
        <div class="center-button">
                <button class="vex-dialog-button-primary vex-dialog-button vex-first">Edit</button>
                <!--<button class="vex-dialog-button-secondary vex-dialog-button vex-last">Cancel</button>-->
            </div>
    </form>
</div>

@endsection
