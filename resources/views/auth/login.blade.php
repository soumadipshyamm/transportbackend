@extends('auth.layouts.app')
@section('content')
 <!-- /.login-logo -->
 <div class="card">
    <div class="card-body login-card-body">
      <div class="login-logo"><img src="{{asset('assets/img/login-icon.png')}}" class="" alt=""></div>
      <p class="login-box-msg">Welcome Back<br><span>Login to continue</span></p>

      <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="form-group mb-3">
          <!-- <label class="col-form-label" for="inputSuccess"><i class="fas fa-check"></i> Input with
            success</label> -->
            <input id="email" type="email" class="form-control form-control-border  @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Enter your email id">

            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

        </div>

        <div class="form-group mb-3">
          <!-- <label class="col-form-label" for="inputSuccess"><i class="fas fa-check"></i> Input with
            success</label> -->
            <input id="password" type="password" class="form-control form-control-border  @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password" required>

            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="row">
          <div class="col-6">
            <div class="icheck-primary">
              <input  type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
              <label for="remember">
                Remember me
              </label>
            </div>
          </div>
          <!-- /.col -->
          {{-- <div class="col-6">
            <h6>
                @if (Route::has('password.request'))
                <a class="btn btn-link" href="{{ route('password.request') }}">
                    {{ __('Forgot Password?') }}
                </a>
            @endif
            </h6>
          </div> --}}
          <!-- /.col -->
        </div>

        <div class="row">
          <div class="col-4">
            <button type="submit" class="btn signbtn">SIGN IN</button>
          </div>
        </div>
      </form>
    </div>
    <!-- /.login-card-body -->
@endsection
