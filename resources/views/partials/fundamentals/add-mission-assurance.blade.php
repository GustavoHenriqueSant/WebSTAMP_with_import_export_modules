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
                        <div class="text"><textarea style="width: 100%; height: 100px;"></textarea></div>
                        <div class="text"><textarea style="width: 100%; height: 100px;"></textarea></div>
                        <div class="text"><textarea style="width: 100%; height: 100px;"></textarea></div>
                    </div>
                    <div class="table-row">
                        <div class="text center">
                            <b>An [online bank system] to </b>
                                allow a user accesses his account info through any device 
                            <br/> 
                            <b>by means of </b>
                                [registering with the institution] and [performing financial transactions],
                            <br/> 
                            <b>in order to contribute to </b>
                                secure customer operations.
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
