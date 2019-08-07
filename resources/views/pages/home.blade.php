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
@stop
