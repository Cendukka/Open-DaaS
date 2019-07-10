@extends('layouts.macrolocation')
@section('content')
    <div id="content" class="row">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3>Manage Users </h3>
            </div>
            <div class="panel-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <table class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>Microlocation</th>
                        <th>Type</th>
                        <th>Last Name</th>
                        <th>First Name</th>
                        <th>Username</th>
                    </tr>
                    </thead>
                    @php
                        $users = DB::table('users')
                                    ->where('user_company_id','=',$company->company_id)
                                    ->join('user_types', 'users.user_type_id', '=','user_types.user_type_id')
                                    ->leftJoin('microlocations', 'users.user_microlocation_id', '=','microlocations.microlocation_id')
                                    ->orderBy('user_id')
                                    ->orderBy('user_microlocation_id')
                                    ->orderBy('users.user_type_id')
                                    ->get();

                    @endphp
                    @foreach ($users as $user)
                        <tr>
                            <td>{{title_case($user->microlocation_name)}}</td>
                            <td>{{title_case($user->user_typename)}}</td>
                            <td>{{title_case($user->last_name)}}</td>
                            <td>{{title_case($user->first_name)}}</td>
                            <td>{{title_case($user->username)}}</td>
                            <td><a href="{{url('/companies/'.$company->company_id.'/manage/users/'.$user->user_id.'/edit')}}">Edit</a></td>
                        </tr>
                    @endforeach
                </table>
                    <form action="{{url(url()->current().'/create')}}">
                    <button type="submit" class="btn btn-secondary">+ Add user</button>
                </form>
            </div>
        </div>
    </div>
@endsection