@extends('layouts.master')

@section('content')

<div id="msg_validation_import">
    @if(session()->has('success'))
    <p>{{ session('success')}} </p>
    <script>
        set_div_timeout("msg_validation_import");
    </script>
    @endif
    @if(session()->has('failure'))
    <p> {{session('failure')}} </p>
    @endif
    @if(session()->has('suspect'))
    <p> {{session('suspect')}} </p>
    @endif
</div>

<div class="substep substep--project" id="project">
    <div class="substep__title">
        Projects
    </div>

    <div class="substep__add" id="add-new-project">
        +
    </div>

    <form id="import_project_div" action="/importproject" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <label for="import"> <img id="image_import_file" title="Import Project" src="images/import.png"> </label>
        <input type="file" id="import" name="import" style="display: none;" accept=".json, .xml">
        <input type="submit" id="enviar_file_import" name="enviar_file_import" style="display: none;" onclick="import_loading()">
    </form>


    <div class="substep__content">
        <ul class="substep__list">
            @foreach (App\Team::where('user_id', Auth::user()->id)->get() as $team)
            @foreach (App\Project::where('id', $team->project_id)->get() as $project)
            <li class="item" id="project-{{$project->id}}">
                <div class="item__title">
                    {{$project->name}}
                    @php
                        $idProjeto = $project->id;
                    @endphp
                </div>
                <div class="item__actions">
                    <form action="{{$project->URL}}/stepone" method="POST" class="edit-form ajaxform">
                        <div class="item__title">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <input id="project_id" name="project_id" type="hidden" value="{{$project->id}}">
                            <input type="submit" class="add-button" value="Open project"></input>
                            <!-- <button>Selecionar este Projeto</button> -->
                        </div>
                    </form>
                    <form action="/exportproject" method="POST" class="ajaxform">
                        <div class="item__title" id="{{$idProjeto}}">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <input id="project_id_export" name="project_id_export" type="hidden" value="{{$idProjeto}}">
                            <input type="text" name="option_export" id="option_export-{{$idProjeto}}" style="display: none;"></input>
                            <input type="submit" id="export_button-{{$idProjeto}}" class="export-button" style="display: none;"></input>
                            <div id="export_options_div_master">
                                <label for="export_options"> <img src="images/export.png" id="image_export_options" style="width: 18px; height: 18px;"> </label>
                                <select id="export_options" name="export_options" class="ls-select" style="height: 25px; width: 147px;" onchange="exportar_project(this.value, '{{$idProjeto}}');">
                                    <option value="0" disabled selected>&nbsp Exportar Project</option>
                                    <option value="1"> &nbsp XML</option>
                                    <option value="2"> &nbsp JSON</option>
                                </select>
                            </div>
                            <!-- div para bot�o de exportar projeto -->
                        </div>
                    </form>
                    <form action="/editproject" method="POST" class="editing-form ajaxform">
                        <div class="item__title">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <input id="project_id" name="project_id" type="hidden" value="{{$project->id}}">
                            <input id="project_name" name="project_name" type="hidden" value="{{$project->name}}">
                            <input id="project_description" name="project_description" type="hidden" value="{{$project->description}}">
                            <input type="submit" class="edit-button" value="Edit project information"></input>
                            <!-- <button>Editar este Projeto</button> -->
                        </div>
                    </form>
                    <form action="/deleteproject" method="POST" class="deleting-form ajaxform">
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
            <hr />
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
                <input type="hidden" id="user-email" value="{{Auth::user()->email}}" />
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
            <hr />
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
                <input type="hidden" id="user-email" value="{{Auth::user()->email}}" />
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

<div id="import_loading" style="display: none;">
    <p>Importing project, please wait...</p>
    <button id="ok_import_button"> OK </button>
</div>

<div id="send_import_file" style="display: none;">
    <form action="/importproject" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <label for="import"></label>
        <input type="file" id="import" name="import" style="display: none;">
        <button type="submit">Importar</button>
    </form>
</div>

@endsection