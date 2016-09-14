<div class="substep__title">
    Rule
</div>

<div class="substep__content">

    <div class="container">

        <div class="container-fluid" style="margin-top: 10px">

        <div class="table-row header">
            @foreach (App\Variable::all() as $variable)
                <div class="text">{{$variable->name}}</div>
            @endforeach
        </div>

        <div class="table-row">
            <div class="text">Fully Open</div>
            <div class="text">Nothing in doorway</div>
            <div class="text">Aligned at platform</div>
            <div class="text">Stopped</div>
            <div class="text">Emergency Required</div>
        </div>

        <div class="table-row">
            <div class="text">Fully Open</div>
            <div class="text">Nothing in doorway</div>
            <div class="text">Aligned at platform</div>
            <div class="text">Stopped</div>
            <div class="text">Emergency Required</div>
        </div>

        <div class="table-row">
            <div class="text">Fully Open</div>
            <div class="text">Nothing in doorway</div>
            <div class="text">Aligned at platform</div>
            <div class="text">Stopped</div>
            <div class="text">Emergency Required</div>
        </div>

        </div>        

    </div>

</div>