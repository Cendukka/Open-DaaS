@extends( 'layouts.macrolocation')
@section ('title', 'Raportit: Hienolajiteltu')
@section('content')
    <div id="content2" class="row">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3>Hienolajittelu </h3>
            </div>
            <div class="panel-body p-4">
                @include('includes.forms.search')
                <table class="table table-light table-striped table-hover table-bordered">
                    <thead class="thead-dark">
                    <tr>
                        <th>Päivämäärä</th>
                        <th>Toimipiste</th>
                        <th>Paino (Kg)</th>
                        <th>Materiaali</th>
                        <th>Käyttäjä</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody id="searchtable">
                    </tbody>
                </table>
                <form action="{{url('companies/'.$company->company_id.'/manage/refined/create')}}">
                    <button type="submit" class="btn btn-secondary">+ Luo hienolajittelu kirjaus</button>
                </form>
                <br>
                <button id="export" type="button" class="btn">Export exceliin</button>
            </div>
        </div>
    </div>
    @include('includes.search_script')
    @include('includes.export_script')
@endsection
