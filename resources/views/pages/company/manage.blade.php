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
                        <li><a href="users">Users</a></li>
                        <li><a href="microlocations">Microlocations</a></li>
                        <li><a href="receipts">Receipts</a></li>
                        <li><a href="issues">Issues</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection