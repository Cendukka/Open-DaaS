@extends('layouts.macrolocation')
@section ('title', 'Raportit: Lähteneet')
@section('content')
    
    <div id="content2" class="row">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3>Lähteneet lähetykset</h3>
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <div class="col-sm-6">
                        <label for="from-date">From: </label>
                        <input type="date" class="form-control datepicker-autoclose" id="from-date" name="from-date" value="{{date('Y-m-d', strtotime("-12 months", strtotime(date('Y-m-d'))))}}">
                    </div>
                    <div class="col-sm-6">
                        <label for="to-date">To: </label>
                        <input type="date" class="form-control datepicker-autoclose" id="to-date" name="to-date" value="{{date('Y-m-d')}}">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-8">
                        <label for="search">Haku: </label>
                        <input type="text" class="form-controller" id="search" name="search" placeholder="Hae...">
                    </div>
                </div>
                <table class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>Aikaleima</th>
                        <th>Mihin Microlokaatioon</th>
                        <th>Mistä Microlokaatiosta</th>
                        <th>Käyttäjänimi</th>
                        <th>Lähetyksen tyyppi</th>
                        {{--<th>Materials</th>--}}
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @include('includes.search_script')
@endsection
