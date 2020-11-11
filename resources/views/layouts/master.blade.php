<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>WebSTAMP</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
  <nav class="navbar">
    <div class="navbar__item">
      <img src="{{ asset('images/logo-ita.png') }}" alt="ITA" class="navbar__logo">
    </div>

    @if (Auth::check())
      @if(isset($slug))
        <div class="navbar__item">
          <div class="navbar__item__content">
            <a href="/{{$slug}}/stepone" class="navbar__item__link">
              Purpose of the Analysis
            </a>
          </div>
          <div class="navbar__item__substeps">
            <div class="navbar__item__substep">
              <a href="/{{$slug}}/stepone#systemgoals" class="navbar__item__link">
                System Goals
              </a>
            </div>
            <div class="navbar__item__substep">
              <a href="/{{$slug}}/stepone#assumptions" class="navbar__item__link">
                Assumptions
              </a>
            </div>
            <div class="navbar__item__substep">
              <a href="/{{$slug}}/stepone#losses" class="navbar__item__link"> <!-- TROCAR POR LOSSES -->
                Losses
              </a>
            </div>
            <div class="navbar__item__substep">
              <a href="/{{$slug}}/stepone#hazards" class="navbar__item__link">
                System-level Hazards
              </a>
            </div>
            <div class="navbar__item__substep">
              <a href="/{{$slug}}/stepone#systemsafetyconstraint" class="navbar__item__link">
                System-level Safety Constraints
              </a>
            </div>
            
          </div>
        </div>

        <div class="navbar__item">
          <div class="navbar__item__content">
            <a href="/{{$slug}}/steptwo" class="navbar__item__link"> <!-- TROCAR PELA NOVA ROTA PARA PAGINA STEP TWO -->
              Control Structure
            </a>
          </div>
        </div>

        <div class="navbar__item">
          <div class="navbar__item__content">
            <a href="/{{$slug}}/stepthree" class="navbar__item__link"> <!-- TROCAR PELA NOVA ROTA PARA PAGINA STEP THREE-->
              Unsafe Control Actions
            </a>
          </div>
        </div>

        <div class="navbar__item">
          <div class="navbar__item__content">
            <a href="/{{$slug}}/stepfour" class="navbar__item__link"> <!-- TROCAR PELA NOVA ROTA PARA PAGINA STEP FOUR -->
              Loss Scenarios
            </a>
          </div>
        </div>

      @endif

      <div class="navbar__item navbar__item--right">
        <div class="navbar__item__content">
          <a href="/" class="navbar__item__link">
            {{Auth::user()->name}}
          </a>
        </div>
        <div class="navbar__item__substeps">
          <!-- <div class="navbar__item__substep">
            <a href="/#systemgoals" class="navbar__item__link">
              My Info
            </a>
          </div> -->
          <div class="navbar__item__substep">
            <a href="/projects" class="navbar__item__link">
              My Projects
            </a>
          </div>
          <div class="navbar__item__substep">
            <a href="{{ url('/logout') }}" class="navbar__item__link">
              Logout
            </a>
          </div>
        </div>
      </div>
    
    @else

      <div class="navbar__item">
        <div class="navbar__item__content">
          <a href="/#tool" class="navbar__item__link">
            WebSTAMP
          </a>
        </div>
      </div>

      <div class="navbar__item">
        <div class="navbar__item__content">
          <a href="/#about" class="navbar__item__link">
            About
          </a>
        </div>
      </div>

      <div class="navbar__item">
        <div class="navbar__item__content">
          <a href="/#authors" class="navbar__item__link">
            Authors
          </a>
        </div>
      </div>

      <div class="navbar__item navbar__item--right">
        <div class="navbar__item__content">
          <a href="/login" class="navbar__item__link">
            Login
          </a>
        </div>
      </div>
      
      <div class="navbar__item navbar__item--right">
        <div class="navbar__item__content">
          <a href="/register" class="navbar__item__link">
            Register
          </a>
        </div>
      </div>

    @endif
  </nav>

  <div class="content">
    @yield('content')
  </div>

  <div class="dialogs">
    @yield('dialogs')
  </div>

  <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
