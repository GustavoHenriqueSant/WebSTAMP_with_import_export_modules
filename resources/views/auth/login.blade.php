@extends('layouts.master')

@section('content')

<script type="text/javascript">
    localStorage.clear();
</script>

<div class="login">
    <!-- <h2>Welcome!</h2> -->
    <h2>Login</h2>
    <hr/>
    <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
        {{ csrf_field() }}

        <div class="field">
            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <label for="email">E-mail Adress</label>
                <input id="email" type="email" class="login-input" name="email" value="{{ old('email') }}" placeholder="Insert your e-mail">

                @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="field">
            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                <label for="password">Password</label>
                <input id="password" type="password" class="login-input" name="password" placeholder="Insert your password">

                @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <!-- <div class="checkbox">
            <label>
                <input type="checkbox" name="remember"> Remember Me
            </label>
        </div> -->

        <div class="verify-credentials">
            <button type="submit">
                Login
            </button>

            <a href="{{ url('/password/reset') }}">Forgot Your Password?</a>
        </div>
    </form>
</div>
@endsection
