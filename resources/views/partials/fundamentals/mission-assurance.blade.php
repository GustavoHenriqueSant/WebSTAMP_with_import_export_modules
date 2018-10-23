<div class="substep__title">
    System Purpose and Goals
</div>

<div class="substep__add add-mission-assurance" id="mission-assurance">
    +
</div>


<div class="substep__content">
    <ul class="substep__list">
        @foreach (App\Mission::where('project_id', $project_id)->get() as $mission)
        <?php
            $method_string = explode(";", $mission->method);
            $method = "";
            $method_length = count($method_string);
            foreach ($method_string as $index => $m) {
                if ($index < $method_length-2)
                    $method .= " [" . $m . "],";
                else if ($index == $method_length-2)
                    $method .= " [" . $m . "] and ";
                else
                    $method .= " [" . $m . "]";
            }
            $goal_string = explode(";", $mission->goals);
            $goal = "";
            $goal_length = count($goal_string);
            foreach ($goal_string as $index => $g) {
                if ($index < $goal_length-2)
                    $goal .= " [" . $g . "],";
                else if ($index == $goal_length-2)
                    $goal .= " [" . $g . "] and ";
                else
                    $goal .= " [" . $g . "]";
            }
        ?>
        <div>
            <div id="mission-project" style="float: left;">
                <b>A [{{$project_name}}] to </b> 
                    <label class="label-for-mission-purpose">{{$mission->purpose}}</label> 
                <br/> 
                <b>by means of </b> 
                    <label class="label-for-mission-method">{{$method}}</label>
                <br/> 
                <b>in order to contribute to </b> 
                    <label class="label-for-mission-goal">{{$goal}}</label>
            </div>
            <div style="float: right;">
                <form action ="/editmission" method="POST" id="editing-mission">
                    <div class="item__title">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <input id="project_id" name="project_id" type="hidden" value="{{$project_id}}">
                        <input id="mission_id" name="mission_id" type="hidden" value="{{$mission->id}}">
                        <input type="image" src="{{ asset('images/edit.ico') }}" alt="Edit" width="20" class="navbar__logo">
                    </div>
                </form>
            </div>
        </div>
        <input type="hidden" id="mission-purpose" value="{{$mission->purpose}}"/>
        <input type="hidden" id="mission-method" value="{{$mission->method}}"/>
        <input type="hidden" id="mission-goal" value="{{$mission->goals}}"/>
        @endforeach
    </ul>
</div>
