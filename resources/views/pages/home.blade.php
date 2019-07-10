@extends('layouts.default')
@section('title', 'Menu')
@section('content')
    <div id="content2" class="row">
        <div class="panel panel-default">
            <div class="panel-heading">
                @guest
                @else
                    <h2>Welcome  {{ Auth::user()->first_name }}</h2>
                    <br>

                @endguest
            </div>
            <div class="panel-body">
                <h4>Tämä on etusivu</h4>
                <p>Tähän voidaan keksiä mitä vain halutaan näyttää ensimmäisena, kun kirjautunut käyttäjä saapuu järjestelmän hallinta osioon.</p>
            </div>
        </div>
    </div>
<!-- <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                        You are logged in!

                    @else
                        <a href="{{ route('login') }}">Login</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a> -->
                         <!-- @endif --> 
                 <!--   @endauth
                </div>
            @endif
            <br>
            <br>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Welcome to Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div>
        </div>
    </div>
</div> -->

@stop
