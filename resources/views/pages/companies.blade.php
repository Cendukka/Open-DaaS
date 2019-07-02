@extends('layouts.default')
@section('content')
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3>Companies </h3>
            </div>
            <div class="panel-body">
                <table class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Address</th>
                        <th>Postcode</th>
                        <th>City</th>
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
                <form action="{{url(url()->current().'/create')}}">
                    <button type="submit" class="btn btn-secondary">+ Add Company</button>
                </form>
            </div>
        </div>
    </div>
@endsection