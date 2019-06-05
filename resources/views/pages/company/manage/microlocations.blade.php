@extends('layouts.macrolocation')
@section('content')
    <div id="macrolocation_name" class="row">
        @include('includes.macrolocation_name',['no_navbar' => true])
    </div>
    <div id="content" class="row">
        <div class="col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <ul class="nav">
                        <li><a href="/companies/{{$company->company_id}}/users">Users</a></li>
                        <li><a href="/companies/{{$company->company_id}}/microlocations">Microlocations</a></li>
                        <li><a href="/companies/{{$company->company_id}}/receipts">Receipts</a></li>
                        <li><a href="/companies/{{$company->company_id}}/issues">Issues</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection