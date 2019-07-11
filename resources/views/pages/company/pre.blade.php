@extends('layouts.macrolocation')
@section ('title', 'Raportit: Esilajiteltu')
@section('content')
    <!--<div id="macrolocation_name" class="row">
        @include('includes.macrolocation_name')
        </div>-->
    <div id="content2" class="row">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3>Esilajittelu </h3>
            </div>
            <div class="panel-body">
                <div class="form-group form-text-align-padd margin-bottom-4-percent">
                    <div class="col-sm-4">
                        <label for="search">Haku: </label>
                        <input type="text" class="form-control" id="search" name="search" placeholder="Hae...">
                    </div>
                    <div class="col-sm-4">
                        <label for="from-date">From: </label>
                        <div style="position: relative">
                            <input type="text" class="form-control timepicker" id="from-date" name="from-date" value="{{date('Y-m-d', strtotime("-12 months", strtotime(date('Y-m-d'))))}}">
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <label for="to-date">To: </label>
                        <div style="position: relative">
                            <input type="text" class="form-control timepicker" id="to-date" name="to-date" value="{{date('Y-m-d')}}">
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
                <form action="{{url('companies/'.$company->company_id.'/manage/pre/create')}}">
                    <button type="submit" class="btn btn-secondary">+ Lisää esilajiteltu</button>
                </form>
            </div>
        </div>
    </div>
    @include('includes.search_script')
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <script type="text/javascript">
        $('.timepicker').datepicker({
            format: 'yyyy-mm-dd'
        });
    </script>
@endsection
