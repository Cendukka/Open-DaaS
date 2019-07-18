@extends('layouts.default')
@section ('title', 'Toimipisteet')
@section('content')
    <div id="content2" class="row">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3>Valitse yhtiö:</h3>
            </div>
            <div class="panel-body">
                <form>
                    @foreach (DB::table('company')->get() as $company)
                        <a href="{{url('/companies/'.$company->company_id.'/manage/users')}}">{{title_case($company->company_name)}}</a>
                        <br>
                        <br>
                    @endforeach
                </form>
            </div>
        </div>
    </div>
@endsection

