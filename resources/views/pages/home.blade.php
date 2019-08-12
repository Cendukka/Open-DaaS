@extends('layouts.default')
@section('title', 'Menu')
@section('content')
    <div class="form-group">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3>Tervetuloa  {{ Auth::user()->first_name }}</h3>
            </div>
            <div class="panel-body pt-4 pb-4">
                <h4>Tämä on etusivu</h4>
                <p>Tähän voidaan keksiä mitä vain halutaan näyttää ensimmäisena, kun kirjautunut käyttäjä saapuu järjestelmän hallinta osioon.</p>
            </div>
        </div>
    </div>
@endsection
