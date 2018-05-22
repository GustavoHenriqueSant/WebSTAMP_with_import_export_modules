@extends('layouts.master')

@section('content')

<div class="login" id="tool" style="width: 60%; margin: auto; padding: 10px;">
    <hr/>
    <h1 style="text-align: center;">About STPA Tool</h1>
    <hr/>
    <p>The STPA Tool (a provisory name to a tool that currently supports only Systems-Theoretic Process Analysis) intends to become an STAMP tool, offering support to STPA-Sec (Systems-Theoretic Process Analysis for Security) and other techniques that extends the model STAMP.</p>

    <p>The STPA Tool currently provides an environment to safety analysts to complete and review their STPA analysis. The tool embraces two approaches, that intends to help beginner safety analysts to understand STPA and complete it in a whole. Despite that, the approaches also can be used for intermediarium or expert analysts.</p>

    <p></p>

    <p>The STPA Tool was created to provide an environment to safety analysists complete their STPA Analysis. To introduce beginner analysists on STPA technique (however, the tool can be used for experient analysts as well), the tool embraces two approaches: The first one is a rule-based approach developed by Gurgel et al. to help analysts to find unsafe control actions based on the analysis of all possible contexts (the approach assumes that the system can be modelled using variables). The second approach provides a list of generic scenarios, associated causal factors, requirements and rationale. The analyst can choose items of this list and add (and posterly, tailor them) them to his analysis.</p>

    
</div>
<br/>
<div class="login" id="about" style="width: 60%; margin: auto; padding: 10px;">
    <hr/>
    <h1 style="text-align: center;">About STAMP/STPA</h1>
    <hr/>
    <p>
        STPA (System-Theoretic Process Analysis) is a technique based on STAMP (Systems-Theoretic Accident Model and Processes) for accident analysis [1]. STAMP/STPA has attracted attention in many areas, especially in avionics, aircraft system design, air traffic control, nuclear power plants, and others.
    </p>
    
    <p>
        STPA consists of two steps that are used to identify safety constraints and recommendations. STPA Step 1 identifies potential Unsafe Control Actions (UCA) and STPA Step 2 reveals potential causes of unsafe control.
    </p>

    <p>
        STPA Step 2 provides knowledge to assist the designers in eliminating or mitigating the potential causes of hazards. It requires critical thinking and experience from analysts (we consider that the analysts are a group of specialists responsible to the safety analysis). STPA Step 2 is, in general, comprehensive and it demands expertise, time, and effort for elaboration and verification. This fact explains why there exists less help provided when compared to Step 1 and why it is more difficult to automate it.
    </p>
</div>
<br/>
<div class="login" id="authors" style="width: 60%; margin: auto; padding: 10px;">
    <hr/>
    <h1 style="text-align: center;">Authors</h1>
    <hr/>
    <p class="author-name">Fellipe Guilherme Rey de Souza</p>
    <p>
        Bachelor in Computer Science by Universidade Federal de Alfenas (2014), Master's Degree in Eletronic Engineering and Computing from the Instituto Tecnológico de Aeronáutica (2017). Currently, he is a regular student of PhP in Instituto Tecnológico de Aeronáutica and a Substitute Professor on Universidade Federal de Alfenas.
    </p>
    <p class="author-name">Celso Massaki Hirata</p>
    <p>
        He holds a bachelor's degree in Mechanical and Aeronautical Engineering from the Instituto Tecnológico de Aeronáutica (1982), a Master's degree in Aeronautical and Mechanical Engineering from the Instituto Tecnológico de Aeronáutica (1987) and a Ph.D. in Computer Science (Imperial College of Science, Technology and Medicine, 1995). He is currently a full professor at the Instituto Tecnológico de Aeronáutica.</p>
    <p class="author-name">Rodrigo Martins Pagliares
    </p>
    <p>
        Bachelor in Computer Science by the Universidade Federal de Ouro Preto (1999), Master's Degree in Computer Science from the Universidade Federal de Santa Catarina (2002) and PhD in Electronic Engineering and Computing by Instituto Tecnológico de Aeronáutica (2017). Currently is Assistant Professor II of the bachelor's degree course in Computer Science, Federal University of Alfenas, UNIFAL-MG.
    </p>


</div>

                    

@endsection