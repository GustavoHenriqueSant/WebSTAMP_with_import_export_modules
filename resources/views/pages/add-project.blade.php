<div id="add-project" style="display: none;">
    <form action="/addproject" class="adding-project" method="POST">
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <div class="vex-dialog-form">
            <div class="container">
                <div class="container-fluid">
                    <div class="table-row header">
                        <div class="text">Suggested Unsafe Control Actions</div>
                        <div class="text">Suggested Associated Safety Constraints</div>
                        <div class="content-uca">Include?</div>
                    </div>
                    <div id="suggested-content-{{$ca->id}}">
                    </div>
                </div>
                
                
                <div class="vex-dialog-input"></div>
                <div class="vex-dialog-buttons">
                    <div style="display: table; margin: 0 auto;">
                        <button class="vex-dialog-button-primary vex-dialog-button vex-first">Add</button>
                        <!--<button class="vex-dialog-button-secondary vex-dialog-button vex-last">Cancel</button>-->
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>