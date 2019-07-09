@extends('layouts.default')
@section ('title', 'Toimipisteet')
@section('content')
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3>Yhtiöt </h3>
            </div>
            <div class="panel-body">
                <table class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>Nimi</th>
                        <th>Osoite</th>
                        <th>Postinumero</th>
                        <th>Kaupunki</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach (DB::table('company')->get() as $company)
                        <tr>
                            <td><a href="{{url('/companies/'.$company->company_id)}}">{{title_case($company->company_name)}}</a></td>
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
