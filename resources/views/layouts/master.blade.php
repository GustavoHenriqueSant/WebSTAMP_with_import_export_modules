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
          <a href="/#components" class="navbar__item__link">
            Components
          </a>
        </div>
        <div class="navbar__item__substep">
          <a href="/#controlactions" class="navbar__item__link">
            Control Action
          </a>
        </div>
        <div class="navbar__item__substep">
          <a href="/#variables" class="navbar__item__link">
            Variable
          </a>
        </div>
        <div class="navbar__item__substep">
          <a href="/#states" class="navbar__item__link">
            State
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
        <a href="/" class="navbar__item__link">
          STPA Step 2
        </a>
      </div>
    </div>

    <div class="navbar__item navbar__item--right">
      <div class="navbar__item__content">
        <a href="/" class="navbar__item__link">
          User info
        </a>
      </div>
    </div>
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
