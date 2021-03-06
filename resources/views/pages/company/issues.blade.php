
{{--        Shows certain information of made records of issues--}}

@extends( 'layouts.macrolocation')
@section ('title', 'Raportit: Lähetykset')
@section('content')

    <div id="content2" class="row">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3>Lähteneet lähetykset</h3>
            </div>
            <div class="panel-body pb-4">
                @include('includes.forms.search')
                <table class="table table-light table-striped table-hover table-bordered">
                    <thead class="thead-dark">
                    <tr>
                        <th>Päivämäärä</th>
                        <th>Lähetyksen lähde</th>
                        <th>Lähetyksen tyyppi</th>
                        <th>Lähetyksen kohde</th>
                        <th>Kirjauksen tekijä</th>
                        <th>Määrä (Kg)</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody id="searchtable">
                    </tbody>
                </table>
                <form action="{{url('companies/'.$company->company_id.'/manage/issues/create')}}">
                    <button type="submit" class="btn btn-secondary">+ Lisää lähetys</button>
                </form>
                <br>
                <button id="export" type="button" class="btn">Lataa ja tallenna CSV-muotoon</button>
            </div>
        </div>
    </div>
    @include('includes.search_script')
    @include('includes.export_script')
@endsection
