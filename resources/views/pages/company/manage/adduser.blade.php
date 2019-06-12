@extends('layouts.macrolocation')
@section('content')
    <div id="macrolocation_name" class="row">
        @include('includes.macrolocation_name',['no_navbar' => true])
    </div>
    <div id="content" class="row">
        <div class="col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
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
                            <label for="user_type">User Type: </label>
                            <select name="user_type">
                                <option value="1">Superadmin</option>
                                <option value="2">Admin</option>
                                <option value="3">Manager</option>
                                <option value="4">User</option>
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
                                    <option value="{{$ml->microlocation_id}}">{{title_case($ml->microlocation_city).', '.title_case($ml->microlocation_name)}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="first_name">First Name: </label>
                            <input type="text" class="form-control" name="first_name"/>
                        </div>
                        <div class="form-group">
                            <label for="last_name">Last Name: </label>
                            <input type="text" class="form-control" name="last_name"/>
                        </div>
                        <div class="form-group">
                            <label for="username">Username: </label>
                            <input type="text" class="form-control" name="username"/>
                        </div>
                        <div class="form-group">
                            <label for="password">Password: </label>
                            <input type="text" class="form-control" name="password" value="qwerty" readonly style="color:lightgray;">
                        </div>
                        <br>
                        <button type="submit" class="btn btn-primary">Add</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection