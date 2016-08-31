@extends('layouts.master')

@section('content')
    <div class="substep substep--addrule" id="addrule">
        @include('partials.stepone.addrules')
    </div>
        <div class="substep substep--rule" id="rule">
        @include('partials.stepone.rules')
    </div>
@endsection