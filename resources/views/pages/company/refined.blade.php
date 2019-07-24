@extends('layouts.macrolocation')
@section ('title', 'Raportit: Hienolajiteltu')
@section('content')
    <!--<div id="macrolocation_name" class="row">
        @include('includes.macrolocation_name')
        </div>-->
    <div id="content2" class="row">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3>Hienolajittelu </h3>
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <div class="col-sm-4">
                        <div class="form-group row">
                            <label for="search" class="col-sm-2 col-form-label form-text-align-padd">Haku:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="search" name="search" placeholder="Hae...">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group row">
                            <label for="from-date" class="col-sm-2 col-form-label form-text-align-padd">From:</label>
                            <div class="col-sm-8">
                                <input type="date" class="form-control timepicker" id="from-date" name="from-date" value="{{date('Y-m-d', strtotime("-12 months", strtotime(date('Y-m-d'))))}}">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group row">
                            <label for="date-date" class="col-sm-2 col-form-label form-text-align-padd">To:</label>
                            <div class="col-sm-8">
                                <input type="date" class="form-control timepicker" id="to-date" name="to-date" value="{{date('Y-m-d')}}">
                            </div>
                        </div>
                    </div>
                </div>
                <table class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>Aikaleima</th>
                        <th>Microlokaatio</th>
                        <th>Paino (Kg)</th>
                        <th>Materiaali</th>
                        <th>Käyttäjä</th>
                    </tr>
                    </thead>
                    <tbody id="searchtable">
                    </tbody>
                </table>
                <form action="{{url('companies/'.$company->company_id.'/manage/refined/create')}}">
                    <button type="submit" class="btn btn-secondary">+ Luo hienolajittelu kirjaus</button>
                </form>

                <button id="export" type="button" class="btn">Export Data</button>
            </div>
        </div>
    </div>
    @include('includes.search_script')
    @include('includes.export_script')
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <script type="text/javascript">
        $('.timepicker').datepicker({
            format: 'yyyy-mm-dd'
        });
    </script>
@endsection
