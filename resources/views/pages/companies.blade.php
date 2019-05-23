@extends('layouts.default')
@section('title', 'Location')
@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    @foreach ($allCompanies as $company)
                        <div class="panel-heading">
                            <a href="{{url('/companies/'.$company->ID)}}">{{title_case($company->Name)}}</a>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
@endsection