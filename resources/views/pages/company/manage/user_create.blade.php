@extends('layouts.macrolocation')
@section('title', 'Create user')
@section('content')
    <div id="content2" class="row">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3>Add user </h3>
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
                <h4>Add User</h4>
                <form method="post" action="users-store">
                    @csrf
                    <div class="form-group">
                        <label for="user_type">User Type:&nbsp</label>
                        <select name="user_type">
                            <option disabled value="1">Superadmin</option>
                            <option value="2">Admin</option>
                            <option value="3">Manager</option>

                        </select>
                    </div>
                    <div class="form-group">
                        <label for="company">Company:&nbsp</label>
                        <select name="company">
                            <option selected="selected" hidden value="{{$company->company_id}}">{{title_case($company->company_name)}}</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="microlocation">Microlocation:&nbsp</label>
                        <select name="microlocation">
                            <option selected="selected" value=""></option>
                            @php
                                $microlocations = DB::table('microlocations')
                                            ->where('microlocation_company_id','=',$company->company_id)
                                            ->get();
                            @endphp
                            @foreach ($microlocations as $ml)
                                <option value="{{$ml->microlocation_id}}">{{title_case($ml->microlocation_city).', '.title_case($ml->microlocation_name)}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="first_name">First Name:&nbsp</label>
                        <input type="text" class="form-control center" name="first_name"/>
                    </div>
                    <div class="form-group">
                        <label for="last_name">Last Name:&nbsp</label>
                        <input type="text" class="form-control center" name="last_name"/>
                    </div>
                    <div class="form-group">
                        <label for="username">Username:&nbsp</label>
                        <input type="text" class="form-control center" name="username"/>
                    </div>
                    <div class="form-group">
                        <label for="password">Password:&nbsp</label>
                        <input type="text" class="form-control center" name="password" value="qwerty" readonly style="color:lightgray;">
                    </div>
                    <br>
                    <button type="submit" class="btn btn-primary">Add</button>
                </form>
            </div>
        </div>
    </div>
@endsection
