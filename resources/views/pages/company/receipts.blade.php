@extends( 'layouts.macrolocation')
@section ('title', 'Raportit: Saapuneet')
@section('content')

    <div id="content2" class="row">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3>Saapuneet lähetykset </h3>
            </div>
            <div class="panel-body pb-3">
                @includeWhen($errors->any(),'includes.forms.errors', ['errors' => $errors])
                @include('includes.forms.search')
                <table class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>Päivämäärä</th>
                        <th>Lähteen tyyppi</th>
                        <th>Saapuneen tavaran lähde</th>
                        <th>Saapuneen tavaran kohde</th>
                        <th>Saapunut materiaali</th>
                        <th>Paino (Kg)</th>
                        <th>Matka (Km)</th>
                        <th>EWC-Koodi</th>
                        <th>Lähetykseen</th>
                    </tr>
                    </thead>
                    <tbody id="searchtable">

                    </tbody>
                </table>
                <form action="{{url('companies/'.$company->company_id.'/manage/receipts/create')}}">
                    <button type="submit" class="btn btn-secondary">+ Lisää saapunut lähetys</button>
                </form>
                <br>
                <button id="export" type="button" class="btn">Export exceliin</button>
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
