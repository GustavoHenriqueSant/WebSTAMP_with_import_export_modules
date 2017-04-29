<div data-component="drop" data-drop="{{ $add }}" class="add-drop">
    <form action ="/add{{$add}}" method="POST" class="add-form" data-add="{{ $add }}">
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <input id="project_id" name="project_id" type="hidden" value="1">
        <div class="add-drop__content">
            @yield('content-add')
        </div>
        <div class="add-drop__buttons">
            @section('buttons')
                <!--<button class="add-drop__action">
                  Cancel
                </button>-->
                <button type="submit" class="add-drop__action">
                  Add
                </button>
            @show
        </div>
    </form>
</div>