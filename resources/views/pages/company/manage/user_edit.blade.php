@extends('layouts.macrolocation')
@section('content')
    <div id="content2" class="row">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3>Edit user </h3>
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
                @php
                    $users = DB::table('users')
                                ->where('user_company_id','=',$company->company_id)
                                ->where('user_id','=',$user->user_id)
                                ->join('user_types', 'users.user_type_id', '=','user_types.user_type_id')
                                ->orderBy('user_microlocation_id')
                                ->orderBy('users.user_type_id')
                                ->get();
                @endphp
                @if(count($users)==0)
                    <h4>User not found</h4>
                @else
                    <h4>Edit User</h4>
                    <form method="post" action="users-update">
                        @csrf
                        <div class="form-group">
                            <label for="user_type">User Type: </label>
                            <select name="user_type">
                                <option {{($user->user_type_id == 1 ? 'selected="selected"' : '')}} disabled value="1">Superadmin</option>
                                <option {{($user->user_type_id == 2 ? 'selected="selected"' : '')}} value="2">Admin</option>
                                <option {{($user->user_type_id == 3 ? 'selected="selected"' : '')}} value="3">Manager</option>
                                <option {{($user->user_type_id == 4 ? 'selected="selected"' : '')}} value="4">User</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="company">Company: </label>
                            <select name="company">
                                <option selected="selected" hidden value="{{$company->company_id}}">{{title_case($company->company_name)}}</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="microlocation">Microlocation: </label>
                            <select name="microlocation">
                                <option selected="selected" value=""></option>
                                @php
                                    $microlocations = DB::table('microlocations')
                                                ->where('microlocation_company_id','=',$company->company_id)
                                                ->get();
                                @endphp
                                @foreach ($microlocations as $ml)
                                    <option {{($ml->microlocation_id == $user->user_microlocation_id ? 'selected="selected"' : '')}} value="{{$ml->microlocation_id}}">{{title_case($ml->microlocation_city).', '.title_case($ml->microlocation_name)}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="first_name">First Name: </label>
                            <input type="text" class="form-control" name="first_name" value="{{$user->first_name}}"/>
                        </div>
                        <div class="form-group">
                            <label for="last_name">Last Name: </label>
                            <input type="text" class="form-control" name="last_name" value="{{$user->last_name}}"/>
                        </div>
                        <div class="form-group">
                            <label for="username">Username: </label>
                            <input type="text" class="form-control" name="username" value="{{$user->username}}" readonly style="color:lightgray;"/>
                        </div>
                        <div class="form-group">
                            <label for="password">Password: </label>
                            <input type="password" class="form-control" name="password" value="{{$user->password}}">
                        </div>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                @endif
            </div>
        </div>
    </div>
@endsection
