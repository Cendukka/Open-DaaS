@extends('layouts.default')
@section ('title', 'Toimipisteet')
@section('content')
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3>Yhtiöt </h3>
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
                        <tr class="text-left">
                            <td><button class="btn" onclick="{{url('/companies/'.$company->company_id)}}">Valitse <span class="glyphicon glyphicon-arrow-right"></span></button></td>
                            <td>{{title_case($company->company_name)}}</td>
                            <td>{{title_case($company->company_street_address)}}</td>
                            <td>{{title_case($company->company_postal_code)}}</td>
                            <td>{{title_case($company->company_city)}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
{{--                <form action="{{url(url()->current().'/create')}}">--}}
{{--                    <button type="submit" class="btn btn-secondary">+ Lisää yhtiö</button>--}}
{{--                </form>--}}
            </div>
        </div>
    </div>
@endsection
