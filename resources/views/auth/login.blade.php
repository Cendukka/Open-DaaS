@extends('layouts.welcomepage')
@section('title', 'Login')
@section('content')
    <div id="content2" class=>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3>Kirjaudu sisään</h3>
            </div>

            <div class="panel-body">
                <div class="form-horizontal" >
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group">
                            <label for="username" class="col-sm-3 control-label">Käyttäjätunnus</label>
                            <div class="col-sm-9">
                                <input id="text" type="username" class="form-control element-width-40 @error('Käyttäjätunnus') is-invalid @enderror" name="username" value="{{ old('username') }}" autocomplete="username" autofocus>

                                @error('username')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password" class="col-sm-3 control-label">Salasana</label>
                            <div class="col-sm-9">
                                <input id="password" type="password" class="form-control element-width-40 @error('Salasana') is-invalid @enderror" name="password" autocomplete="current-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-9">
                                <button type="submit" class="btn btn-primary ">
                                    Kirjaudu sisään
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-primary" href="{{ route('password.request') }}">
                                        Unohditko salasanan?
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection