<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>STPA</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
  <nav class="navbar">
    <div class="navbar__item">
      <img src="{{ asset('images/logo-ita.png') }}" alt="ITA" class="navbar__logo">
    </div>

    @if (Auth::check())
      <div class="navbar__item">
        <div class="navbar__item__content">
          <a href="/" class="navbar__item__link">
            Fundamentals
          </a>
        </div>
        <div class="navbar__item__substeps">
          <div class="navbar__item__substep">
            <a href="/#systemgoals" class="navbar__item__link">
              System Goals
            </a>
          </div>
          <div class="navbar__item__substep">
            <a href="/#accidents" class="navbar__item__link">
              Accidents
            </a>
          </div>
          <div class="navbar__item__substep">
            <a href="/#hazards" class="navbar__item__link">
              Hazards
            </a>
          </div>
          <div class="navbar__item__substep">
            <a href="/#systemsafetyconstraint" class="navbar__item__link">
              System Safety Constraints
            </a>
          </div>
          <div class="navbar__item__substep">
            <a href="/#components" class="navbar__item__link">
              Components
            </a>
          </div>
        </div>
      </div>

      <div class="navbar__item">
        <div class="navbar__item__content">
          <a href="/stepone" class="navbar__item__link">
            STPA Step 1
          </a>
        </div>
      </div>

      <div class="navbar__item">
        <div class="navbar__item__content">
          <a href="/steptwo" class="navbar__item__link">
            STPA Step 2
          </a>
        </div>
      </div>

      <div class="navbar__item navbar__item--right">
        <div class="navbar__item__content">
          <a href="/" class="navbar__item__link">
            {{Auth::user()->name}}
          </a>
        </div>
        <div class="navbar__item__substeps">
          <div class="navbar__item__substep">
            <a href="/#systemgoals" class="navbar__item__link">
              My Info
            </a>
          </div>
          <div class="navbar__item__substep">
            <a href="/#accidents" class="navbar__item__link">
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
            STPA Tool
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
