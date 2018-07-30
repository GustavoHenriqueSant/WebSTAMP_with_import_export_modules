@extends('layouts.master')

@section('content')

<div class="substep substep--project" id="project">
    <div class="substep__title">
        Projects
    </div>

    <div class="substep__add" data-component="add-button" data-add="project">
        +
    </div>

    <div class="substep__content">
        <ul class="substep__list">
            @foreach (App\Project::all() as $project)
                <li class="item" id="project-{{$project->id}}">
                    <div class="item__title">
                        {{$project->name}}

                    </div>
                    <div class="item__actions">
                        <form action ="{{$project->URL}}/fundamentals" method="GET" class="edit-form ajaxform">
                            <div class="item__title">
                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                <input id="project_id" name="project_id" type="hidden" value="{{$project->id}}">
                                <button>Selecionar este Projeto</button>
                            </div>
                        </form>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
    
</div>        

@endsection
