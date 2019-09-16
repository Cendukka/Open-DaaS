@extends('layouts.default')
@section('title', 'Menu')
@section('content')
    <div class="form-group">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3>Tervetuloa  {{ Auth::user()->first_name }}</h3>
            </div>
            <div class="panel-body pt-4 pb-4">
                <h5 class="p-3">Voit aloittaa tarkastelemalla organisaatioita valitsemalla vasemmalta palkista 'Organisaatiot'.</h5>
                <h5 class="p-3">Voit hallinnoida käyttäjiä, materiaaleja tai rekisteröidä uusia organisaatioita 'Hallinnoi'-pudotusvalikosta.</h5>
                <h5 class="p-3">Jos tarvitset apua toimintojen suorittamisessa, valitse 'Ohjeet' vasemmalta palkista.</h5>
                <p></p>
            </div>
        </div>
    </div>
@endsection
