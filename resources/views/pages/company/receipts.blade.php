
{{--        Shows certain information of made records of received textiles--}}


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
                <table class="table table-light table-striped table-hover table-bordered">
                    <thead class="thead-dark">
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
                        <th></th>
                    </tr>
                    </thead>
                    <tbody id="searchtable">

                    </tbody>
                </table>
                <form action="{{url('companies/'.$company->company_id.'/manage/receipts/create')}}">
                    <button type="submit" class="btn btn-secondary">+ Lisää saapunut lähetys</button>
                </form>
                <br>
                <button id="export" type="button" class="btn">Lataa ja tallenna CSV-muotoon</button>
            </div>
        </div>
    </div>
    @include('includes.search_script')
    @include('includes.export_script')
@endsection
