@extends('layouts.welcomepage')
@section('title', 'Login')
@section('content')
<div id="content2" class="row">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3>Sign-in</h3>
        </div>

        <div class="panel-body">
            <div class="form-horizontal" >           
                <form method="POST" action="{{ route('login') }}">
                     @csrf

                     <div class="form-group ">
                            <label for="username" class="col-sm-3 control-label">{{ __('username') }}</label>
                             <div class="col-sm-9">
                                <input id="text" type="username" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>

                                @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password" class="col-sm-3 control-label">{{ __('Password') }}</label>
                                <div class="col-sm-9">
                                 <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-sm-9 form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>

                     
                        <div class="col-sm-9">
                                <button type="submit" class="btn btn-primary ">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-primary" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                        </div>
                </form>
            </div>    
       </div>
    </div>
</div>
@endsection
