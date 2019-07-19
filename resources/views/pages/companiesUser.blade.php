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
                    <table class="table table-borderless table-hover" style="table-layout: auto">
                        <tbody>
                            @foreach (DB::table('company')->get() as $company)
                                <tr>
                                    <td class="text-right "><a href="{{url('/companies/'.$company->company_id.'/manage/users')}}" class="btn btn-info">Valitse <span class="glyphicon glyphicon-arrow-right"></span></a></td>
                                    <td class="text-left">{{title_case($company->company_name)}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </form>
            </div>
        </div>
    </div>
@endsection

