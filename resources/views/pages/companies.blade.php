
{{--        Here is a list of organizations that are saved on database--}}


@extends('layouts.default')
@section ('title', 'Toimipisteet')
@section('content')
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3>Organisaatiot </h3>
            </div>
            <div class="panel-body">
                <table class="table table-light table-striped table-hover table-bordered">
                    <thead class="thead-dark">
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
