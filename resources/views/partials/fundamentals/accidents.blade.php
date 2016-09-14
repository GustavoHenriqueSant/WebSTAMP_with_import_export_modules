<div class="substep__title">
    Accidents
</div>

<div class="substep__add" data-component="add-button" data-add="accident">
    +
</div>

<div class="substep__content">
    <ul class="substep__list">
        @foreach ($accidents as $accident)
            <li class="item" id="accident-{{$accident->id}}">
                <div class="item__title">
                    A-{{$accident->id}}: {{ $accident->name }}
                </div>
                <div class="item__actions">
                    <div class="item__title">
                        <img src="{{ asset('images/edit.ico') }}" alt="Edit" width="20" class="navbar__logo">
                    </div>
                    <!-- <form action ="/deleteaccident" method="POST" class="delete-form" data-delete="accident"> -->
                        <div class="item__title">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <input id="project_id" name="project_id" type="hidden" value="1">
                            <input type="image" src="{{ asset('images/delete.ico') }}" alt="Delete" width="20" class="navbar__logo">
                        </div>
                    <!-- </form> -->
                </div>
            </li>
        @endforeach
    </ul>
</div>
