<div data-component="drop" data-drop="{{ $add }}" class="add-drop">
    <form action ="/enviar{{$add}}" method="POST">
        <div class="add-drop__content">
            @yield('content-add')
        </div>
        <div class="add-drop__buttons">
            @section('buttons')
                <button class="add-drop__action">
                  Cancel
                </button>
                <button type="submit" class="add-drop__action">
                  Add
                </button>
            @show
        </div>
    </form>
</div>