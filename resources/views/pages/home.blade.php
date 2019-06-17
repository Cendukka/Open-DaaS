@extends('layouts.default')
@section('title', 'Location')
@section('content')
<<<<<<< Updated upstream
    i am the home page
=======
<div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>
<!-- 
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a> -->
                        @endif
                    @endauth
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
</div>
    <h4>This is the home page</h4>
>>>>>>> Stashed changes
@stop