@extends('auth.layouts.app')


@section('content')
  <form class="login-form" action="{{ route('login') }}" method="POST">
    @csrf
    <div class="row">
      <div class="input-field col s12 center">
        {{-- <h5 class="mb-1">{{ env('APP_NAME') }}</h5> --}}
        <img src="{{ asset('assets-old/assets/img/lexis.png') }}" class="img-fluid" width="250" />
      </div>
      <div class="input-field col s12">
        <h5 class="ml-4">Sign in</h5>
      </div>
    </div>
    <div class="row margin">
      <div class="input-field col s12">
        <i class="material-icons prefix pt-2"></i>
        <input required autofocus placeholder="Username" id="username" name="username" type="text"
          value="{{ old('username') }}">
      </div>
    </div>
    <div class="row margin">
      <div class="input-field col s12">
        <i class="material-icons prefix pt-2"></i>
        <input required placeholder="Password" id="password" name="password" type="password" value=""
          autocomplete="current-password">
      </div>
    </div>
    <div class="row">
      <div class="col s12 m12 l12 ml-2 mt-1">
        <p>
          <label>
            <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
            <span>Remember Me</span>
          </label>
        </p>
      </div>
    </div>
    <div class="row">
      <div class="input-field col s12">
        <button type="submit"
          class="btn waves-effect waves-light border-round gradient-45deg-purple-deep-orange col s12">
          Login
        </button>
      </div>
    </div>
    <div class="row">
      <div class="input-field col s6 m6 l6">
        {{-- <p class="margin medium-small"><a href="user-register.html">Register Now!</a></p> --}}
      </div>
      <div class="input-field col s6 m6 l6">
        <p class="margin right-align medium-small">
          <a href="user-forgot-password.html">
            Forgot password ?
          </a>
        </p>
      </div>
    </div>
    <div class="progress" id="progress">
      <div class="indeterminate"></div>
    </div>
  </form>
  {{-- <form action="{{ route('login') }}" method="POST" class="form-signin">
    @csrf
    <div class="form-group mb-3">
      <label>Username</label>
      <input id="username" type="username" class="form-control @error('username') is-invalid @enderror" name="username"
        value="{{ old('username') }}" required autocomplete="username" autofocus>

      @error('username')
        <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
        </span>
      @enderror
    </div>
    <div class="form-group mb-3">
      <label>Password</label>
      <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password"
        required autocomplete="current-password">

      @error('password')
        <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
        </span>
      @enderror
    </div>
    <div class="mb-3 row mt-4">
      <div class="col-12">
        <div class="form-check">
          <input class="form-check-input" type="checkbox" name="remember" id="remember"
            {{ old('remember') ? 'checked' : '' }}>

          <label class="form-check-label" for="remember">
            {{ __('Remember Me') }}
          </label>
        </div>
      </div>
      <div class="col-12 mt-3">
        <button class="btn btn-block btn-primary w-md waves-effect waves-light" type="submit" style="width: 100%">Log In</button>
      </div>
    </div>
    @if (!Route::has('password.request'))
      <div class="form-group mb-0 row">
        <div class="col-12 mt-4">
          <a href="{{ route('password.request') }}" class="text-muted"><i class="mdi mdi-lock"></i>
            {{ __('Forgot Your Password?') }}</a>
        </div>
      </div>
    @endif

  </form> --}}
@endsection
