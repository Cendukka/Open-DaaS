@extends('layouts.default')
@section ('title', 'Toimipisteet')
@section('content')
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3>Organisaatiot </h3>
            </div>
            <div class="panel-body table-responsive-lg">
                <table class="table table-bordered table-hover" style="table-layout: fixed">
                    <thead>
                    <tr>
                        <th scope="col"></th>
                        <th scope="col">Nimi</th>
                        <th scope="col">Osoite</th>
                        <th scope="col">Postinumero</th>
                        <th scope="col">Kaupunki</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach (DB::table('company')->get() as $company)
                        <tr class="text-left" style="{{$company->is_disabled ? 'color:lightgray;' : ''}}">
                            <td class="text-center"><a href="{{url('/companies/'.$company->company_id)}}" class="btn btn-info">Valitse</a></td>
                            <td>{{title_case($company->company_name)}}</td>
                            <td>{{title_case($company->company_street_address)}}</td>
                            <td>{{title_case($company->company_postal_code)}}</td>
                            <td>{{title_case($company->company_city)}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
