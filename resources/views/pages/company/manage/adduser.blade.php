@extends('layouts.macrolocation')
@section('content')
    <div id="macrolocation_name" class="row">
        @include('includes.macrolocation_name',['no_navbar' => true])
    </div>
    <div id="content" class="row">
        <div class="col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <table>
                        <tr>
                            <th>ID</th>
                            <th>Microlocation ID</th>
                            <th>Type</th>
                            <th>Last Name</th>
                            <th>First Name</th>
                            <th>Username</th>
                            <th>Password</th>
                        </tr>
                        @php
                            $users = DB::table('users')
                                        ->where('user_company_id','=',$company->company_id)
                                        ->join('user_types', 'users.user_type_id', '=','user_types.user_type_id')
                                        ->orderBy('user_microlocation_id')
                                        ->orderBy('users.user_type_id')
                                        ->get();

                        @endphp
                        @foreach ($users as $user)
                            <tr>
                                <td>{{title_case($user->user_id)}}</td>
                                <td>{{title_case($user->user_microlocation_id)}}</td>
                                <td>{{title_case($user->user_typename)}}</td>
                                <td>{{title_case($user->last_name)}}</td>
                                <td>{{title_case($user->first_name)}}</td>
                                <td>{{title_case($user->username)}}</td>
                                <td>{{title_case($user->password)}}</td>
                            </tr>
                        @endforeach
                    </table>
                    <br>
                    <a href="adduser">+ Add user</a>
                </div>
            </div>
        </div>
    </div>
@endsection