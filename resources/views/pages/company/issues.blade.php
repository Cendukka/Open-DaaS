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
                    <tbody id="searchtable">
                    </tbody>
                </table>
                <form action="{{url('companies/'.$company->company_id.'/manage/issues/create')}}">
                    <button type="submit" class="btn btn-secondary">+ Add Issue</button>
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
