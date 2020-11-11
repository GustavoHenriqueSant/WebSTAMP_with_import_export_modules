@extends('layouts.master')

@section('content')

<div class="login" id="tool" style="width: 60%; margin: auto; padding: 10px;">
    <hr/>
    <h1 style="text-align: center;">About STAMP/STPA</h1>
    <hr/>
    <p>
        STAMP (Systems-Theoretic Accident Model and Processes) is an accident causation model that is based on systems theory and enables safety and security analysis in the concept phase. 
        STAMP has two pairs of ideas: (i) hierarchy & emergence and (ii) communication & control.
        STAMP treats unacceptable losses as a dynamic control problem (vs. a failure problem). 
    </p>

    <p>
        It includes the entire socio-technical system (not just the technical part), losses, and hazards due to components interactions. 
        The result of STAMP modeling is a safety control structure. STAMP/STPA has attracted attention in many areas, especially in avionics, aircraft system design, air traffic control, nuclear power plants, and others.
    </p>

    <p>
        STPA (System-Theoretic Process Analysis) is a hazard analysis technique based on STAMP. 
        STPA consists of four steps: (i) Define the purpose of the analysis, (ii) Model the control structure, (iii) Identify unsafe control actions", and (iv) Identify loss scenarios. 
        Each UCA identified must have an associated controller constraint.
    </p>

    <p> 
        Defining the purpose of the analysis is required for any hazard analysis technique. 
        In the first step, the analysts define the system goals (such as safety, security, privacy, and others), the properties of the system, and its boundaries. 
        Identify losses, system-level hazards, system-level safety constraints, and refine the hazards are parts of that step.
     </p>

    <p>
        The analysts and designers are responsible for model the hierarchical control structure. 
        It has components (such as controllers, actuators, controlled processes, and sensors) and connections (such as control actions, feedback, and communication channel).
     </p>

    <p>
        After model the control structure, the analyst must analyze it and identify the unsafe control actions (UCA). 
        A UCA is a control action that will lead to a hazard in a particular context and worst-case environment. Four ways made a control action unsafe. 
        They are: (a) Not providing causes hazard; (b) Providing causes hazard; (c) Providing in the wrong time or order causes hazard; (d) Stopped too soon or applying too long causes hazard.
     </p>

    <p>
        The last step provides knowledge to assist the designers in eliminating or mitigating the potential causes of hazards. 
        The loss scenario describes the causal factors that can lead to unsafe control actions and hazards. 
        The analysts must identify (a) Why a UCA occur, and (b) Why a safe control action that was issued was improperly executed or not executed.
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
        WebSTAMP currently provides an environment to safety analysts to complete and review their STPA analysis. 
        The tool is aimed to help beginner safety analysts to understand STPA and complete their analyis in a whole. 
        We believe that the tool can speed up the analysis of expert analysts.
    </p>

    <p>
        WebSTAMP was created to provide an environment for safety analysts to perform a complete STPA analysis. 
        The tool embraces two approaches: The first one is a rule-based approach developed by Gurgel et al. to help analysts to find unsafe control actions. 
        The second approach provides a list of generic scenarios, associated causal factors, requirements and rationale based on the type of unsafe control action. 
        The analyst can choose existing scenarios and create new ones. This feature enables a more systematic and comprehensive analysis.
    </p>
    <p>
        Want to know how to use WebSTAMP? Click <a href="/tutorial">here</a> to download the PDF tutorial.
    </p>
</div>
<br/>
<div class="login" id="authors" style="width: 60%; margin: auto; padding: 10px;">
    <hr/>
    <h1 style="text-align: center;">Our Goal</h1>
    <hr/>
    <p>
        We intend to make WebSTAMP available for all users, so that STAMP and STPA techniques can be disseminated and used. In the future, we also intend to leave the tool open and available for further extensions.
    </p>
    <p>
        WebSTAMP is an ongoing development project. Many features are still being implemented. The features include GUI for editing control structure,
        import/export of analysis, report generation, traceability, collaborative analysis, consistency check, and STPA extensios, such as the inclusion 
        of threat model for security.
    </p>
    <p>
        The project is a collaborative effort of many voluntary contributors. They include:
    </p>
    <ul>
        <li><p>Celso Massaki Hirata (ITA) (Project Coordinator, e-mails: hirata@ita.br  hiratacm@gmail.com)</p></li>
        <li><p>Fellipe Guilherme Rey de Souza (ITA)</p></li>
        <li><p>Rodrigo Martins Pagliares (UNIFAL-MG)</p></li>
        <li><p>Juliana de Melo Bezerra (ITA)</p></li>
        <li><p>Filipe Parisoto Ribeiro (UNIFAL-MG)</p></li>
        <li><p>João Hugo Marinho Maimone (UNIFAL-MG)</p></li>
        <li><p>and many others.</p></li>
    </ul>


</div>

                    

@endsection