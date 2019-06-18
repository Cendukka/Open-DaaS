@extends('layouts.macrolocation')
@section('content')
    <div id="content2" class="row">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3>Manage </h3>
            </div>
            <div class="panel-body">
                <ul class="nav">
                    <li><a href="{{url(action('company_controller@edit',['company' => $company]))}}">Company</a></li>
                    <li><a href="{{url(action('user_controller@index',['company' => $company]))}}">Users</a></li>
                    <li><a href="{{url(action('microlocation_controller@index',['company' => $company]))}}">Microlocations</a></li>
                    <li><a href="{{url(action('receipt_controller@index',['company' => $company]))}}">Receipts</a></li>
                    <li><a href="{{url('/companies/'.$company->company_id.'/issues')}}">Issues</a></li>
                </ul>
            </div>
        </div>
    </div>
@endsection
