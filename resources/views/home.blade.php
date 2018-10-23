@extends('layouts.master')

@section('content')

<div class="login" id="tool" style="width: 60%; margin: auto; padding: 10px;">
    <hr/>
    <h1 style="text-align: center;">About STAMP/STPA</h1>
    <hr/>
    <p>
        STAMP (Systems-Theoretic Accident Model and Processes) is an accident causation model that is based on systems theory and enables the safety and security analysis in the concept phase. STAMP has two pairs of ideas: hierarchy &amp; emergence and communication &amp; control. STAMP treats accidents and unacceptable losses as a dynamic control problem (vs. a failure problem). It includes entire socio-technical system (not just technical part), accidents, losses and hazards due to components interactions. The result of STAMP modeling is a safety control structure. STAMP/STPA has attracted attention in many areas, especially in avionics, aircraft system design, air traffic control, nuclear power plants, and others.
    </p>
    
    <p>
        STPA (System-Theoretic Process Analysis) is an accident analysis technique based on STAMP. STPA consists of two steps. Step 1 identifies potential Unsafe Control Actions (UCA) and Step 2 reveals potential causes of unsafe control and generates safety recommendations. STPA Step 2 provides knowledge to assist the designers in eliminating or mitigating the potential causes of hazards.
    </p>

    <p>
        STAMP/STPA requires critical thinking and experience from analysts. It also requires time and effort for a comprehensive analysis.
    </p>
</div>
<br/>

<div class="login" id="about" style="width: 60%; margin: auto; padding: 10px;">
    <hr/>
    <h1 style="text-align: center;">About WebSTAMP</h1>
    <hr/>
    <p>
        WebSTAMP is intended to become an STAMP tool, offering support to STPA (Systems- Theoretic Process Analysis), STPA-Sec (STPA for Security) and other analysis techniques that are based on STAMP.
    </p>

    <p>
        WebSTAMP currently provides an environment to safety analysts to complete and review their STPA analysis. The tool is aimed to help beginner safety analysts to understand STPA and complete their analyis in a whole. We believe that the tool can speed up the analysis of expert analysts.
    </p>

    <p>
        WebSTAMP was created to provide an environment for safety analysts to perform a complete STPA analysis. The tool embraces two approaches: The first one is a rule-based approach developed by Gurgel et al. to help analysts to find unsafe control actions. The second approach provides a list of generic scenarios, associated causal factors, requirements and rationale based on the type of unsafe control action. The analyst can choose existing scenarios and create new ones. This feature enables a more comprehensive analysis.
    </p>
</div>
<br/>
<div class="login" id="authors" style="width: 60%; margin: auto; padding: 10px;">
    <hr/>
    <h1 style="text-align: center;">Our Goal</h1>
    <hr/>
    <p>
        We intend to make WebSTAMP available for all users, so that STAMP and STPA techniques be disseminated and used.
    </p>
    <p>
        In the future, we also intend to leave the tool open and available for further extensions.
    </p>
    <p class="author-name">Fellipe Guilherme Rey de Souza</p>
    <p>
        PhD student, Instituto Tecnológico de Aeronáutica – ITA, and Teaching Assistant, Federal University of Alfenas, UNIFAL.
    </p>
    <p class="author-name">Celso Massaki Hirata</p>
    <p>
        Professor, Computer Science Department, Instituto Tecnológico de Aeronáutica – ITA.
    </p>
    <p class="author-name">Rodrigo Martins Pagliares
    </p>
    <p>
        Assistant Professor, Computer Science Department, Federal University of Alfenas, UNIFAL.
    </p>


</div>

                    

@endsection