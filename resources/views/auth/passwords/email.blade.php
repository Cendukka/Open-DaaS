{{--Form to change forgotten password--}}
@extends('layouts.welcomepage')
@section('title', 'Password reset')
@section('content')
    <div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3>Nollaa salasana</h3>
            </div>

            <div class="panel-body">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <div class="form-horizontal" >
                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-sm-3 control-label">Sähköposti</label>

                            <div class="col-sm-9">
                                <input id="email" type="email" class="form-control element-width-40 @error('Sähköposti') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email" autofocus>
                            </div>

                        </div>
                        <div class="form-group row">
                            @error('email')
                            <div class="col-sm-9">
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            </div>
                            @enderror
                        </div>
                        <div class="col-sm-9">
                            <button type="submit" class="btn btn-primary">
                                Lähetä salasanan palautus linkki
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
@endsection
