
{{--        Shows certain information of made records of presorting processes--}}


@extends( 'layouts.macrolocation')
@section ('title', 'Raportit: Esilajiteltu')
@section('content')
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3>Esilajittelu </h3>
            </div>
            <div class="panel-body p-4">
                @include('includes.forms.search')
                <table class="table table-light table-striped table-hover table-bordered">
                    <thead class="thead-dark">
                    <tr>
                        <th>Päivämäärä</th>
                        <th>Toimipiste</th>
                        <th>Materiaali</th>
                        <th>Paino (Kg)</th>
                        <th>Käyttäjä</th>
                        <th>Lähetykseen</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody id="searchtable">
                    </tbody>
                </table>
                <form action="{{url('companies/'.$company->company_id.'/manage/pre/create')}}">
                    <button type="submit" class="btn btn-secondary">+ Lisää esilajiteltu</button>
                </form>
                <br>
                <button id="export" type="button" class="btn">Lataa ja tallenna CSV-muotoon</button>
            </div>
        </div>
    @include('includes.search_script')
    @include('includes.export_script')
@endsection
