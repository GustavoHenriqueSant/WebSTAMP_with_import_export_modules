@extends('layouts.master')

<?php $fundamentals = ['systemgoals', 'accidents', 'hazards', 'components', 'controlactions', 'variables', 'states']; ?>

@section('content')
    @foreach ($fundamentals as $f)
        <div class="substep substep--{{ $f }}" id="{{ $f }}">
          @include('partials.fundamentals.' . $f)
        </div>
    @endforeach
@endsection

<?php $addItens = ['systemgoals', 'accident', 'hazard', 'component', 'controlactions', 'variable', 'state']; ?>

@section('dialogs')
    @foreach ($addItens as $addItem)
        @include('partials.fundamentals.add-' . $addItem)
    @endforeach
@endsection
