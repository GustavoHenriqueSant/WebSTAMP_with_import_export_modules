@extends('layouts.master')

<?php $stepone= ($project_type == "Security" ) ? ['mission-assurance', 'assumptions',' losses', 'hazards', 'systemsafetyconstraint'] : ['systemgoals', 'assumptions','losses', 'hazards', 'systemsafetyconstraint'];
?>

@section('content')
    @foreach ($stepone as $s)
        <input type="hidden" id="project_id" value="{{$project_id}}">
        <div class="substep substep--{{ $s }}" id="{{ $s }}">
          @include('partials.stepone.' . $s)
        </div>
    @endforeach
@endsection

@include('partials.stepone.add-mission-assurance')

<?php $addItens = ['systemgoals', 'assumption','loss', 'hazard', 'systemsafetyconstraint']; ?>

@section('dialogs')
       <!-- Including all basic stepone-->
    @foreach ($addItens as $addItem)
        @include('partials.stepone.add-' . $addItem)
    @endforeach
@endsection

