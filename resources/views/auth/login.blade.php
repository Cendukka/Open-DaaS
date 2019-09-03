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

                        <div class="form-group row">
                                <label for="username" class="col-sm-3 control-label">Käyttäjätunnus</label>
                            <div class="col-sm-3">
                                <input id="text" type="username" class="form-control @error('Käyttäjätunnus') is-invalid @enderror" name="username" value="{{ old('username') }}" autocomplete="username" autofocus>
                            </div>
                            @error('username')
                            <span class="invalid-feedback element-float-left" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-sm-3 control-label">Salasana</label>
                            <div class="col-sm-3">
                                <input id="password" type="password" class="form-control @error('Salasana') is-invalid @enderror" name="password">
                            </div>
                            @error('password')
                            <span class="invalid-feedback element-float-left" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <div class="col-sm-9">
                                <button type="submit" class="btn btn-primary ">
                                    Kirjaudu sisään
                                </button>

{{--                                @if (Route::has('password.request'))--}}
{{--                                    <a class="btn btn-primary" href="{{ route('password.request') }}">--}}
{{--                                        Unohditko salasanan?--}}
{{--                                    </a>--}}
{{--                                @endif--}}
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
