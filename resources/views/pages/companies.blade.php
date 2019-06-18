@extends('layouts.default')
@section('content')
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3>Companies </h3>
            </div>
            <div class="panel-body">
                <table>
                    <tr>
                        <th>Name</th>
                        <th>Address</th>
                        <th>Postcode</th>
                        <th>City</th>
                    </tr>
                    @php
                        $companies = DB::table('company')->get();
                    @endphp
                    @foreach ($companies as $company)
                        <tr>
                            <td><a href="{{url('/companies/'.$company->company_id)}}">{{title_case($company->company_name)}}</a></td>
                            <td>{{title_case($company->company_street_address)}}</td>
                            <td>{{title_case($company->company_postal_code)}}</td>
                            <td>{{title_case($company->company_city)}}</td>
                        </tr>
                    @endforeach
                </table>
                <br>
                <a href="companies/create">+ Add company</a>
            </div>
        </div>
    </div>
@endsection