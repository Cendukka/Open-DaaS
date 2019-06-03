@extends('layouts.default')
@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    @foreach ($allCompanies as $company)
                        <div class="panel-heading">
                            <a href="{{url('/companies/'.$company->company_id)}}">{{title_case($company->company_name)}}</a>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
@endsection