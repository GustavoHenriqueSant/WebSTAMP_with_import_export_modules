<div id="add-a-new-mission-assurance" style="display: none;">
    <form action="/addmissionassurance" class="adding-mission-assurance" method="POST">
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <div class="vex-dialog-form">
            <div class="container">
                <div class="container-fluid">
                    <div class="table-row header">
                        <div class="text">Defining the Mission</div>
                    </div>
                    <div class="table-row header">
                        <div class="text">What (Purpose)</div>
                        <div class="text">How (Methods)</div>
                        <div class="text">Why (Goals)</div>
                    </div>
                    <div class="table-row center">
                        <div class="text">
                            <textarea class="mission-assurance garamond" id="mission-purpose" placeholder="Insert here the purpose"></textarea>
                        </div>
                        <div class="text">
                            <textarea class="mission-assurance garamond" id="mission-method" placeholder="Insert here the methods (separated by semicolon)"></textarea>
                        </div>
                        <div class="text">
                            <textarea class="mission-assurance garamond" id="mission-goal" placeholder="Insert here the goals (separated by semicolon)"></textarea>
                        </div>
                    </div>
                    <div class="table-row">
                        <div class="text center">
                            <b>A [{{$project_name}}] to </b>
                                <label class="label-mission-purpose"></label> 
                            <br/> 
                            <b>by means of </b>
                                <label class="label-mission-method"></label>
                            <br/> 
                            <b>in order to contribute to </b>
                                <label class="label-mission-goal"></label>
                        </div>
                    </div>
                </div>
            </div>
            
            
            <div class="vex-dialog-input"></div>
            <div class="vex-dialog-buttons">
                <div style="display: table; margin: 0 auto;">
                    <button class="vex-dialog-button-primary vex-dialog-button vex-first">Set the Mission</button>
                    <!--<button class="vex-dialog-button-secondary vex-dialog-button vex-last">Cancel</button>-->
                </div>
            </div>
        </div>
    </form>
</div>
