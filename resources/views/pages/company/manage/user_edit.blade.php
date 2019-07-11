@extends('layouts.macrolocation')
@section('content')
    <div id="content2" class="row">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3>Muokkaa käyttäjää </h3>
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

                    <form method="post" action="users-update">
                        @csrf
                        <div class="form-group">
                            <label for="user_type">Käyttäjä tyyppi:&nbsp</label>
                            <select name="user_type">
                                <option {{($user->user_type_id == 1 ? 'selected="selected"' : '')}} disabled value="1">Superadmin</option>
                                <option {{($user->user_type_id == 2 ? 'selected="selected"' : '')}} value="2">Admin</option>
                                <option {{($user->user_type_id == 3 ? 'selected="selected"' : '')}} value="3">Manager</option>

                            </select>
                        </div>
                        <div class="form-group">
                            <label for="company">Yhtiö:&nbsp</label>
                            <select name="company">
                                <option selected="selected" hidden value="{{$company->company_id}}">{{title_case($company->company_name)}}</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="microlocation">Microlokaatio:&nbsp</label>
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
                            <label for="last_name">Sukunimi:&nbsp</label>
                            <input type="text" maxlength="50" class="form-control" name="last_name" value="{{$user->last_name}}"/>
                        </div>
                        <div class="form-group">
                            <label for="first_name">Etunimi:&nbsp</label>
                            <input type="text" maxlength="50" class="form-control" name="first_name" value="{{$user->first_name}}"/>
                        </div>
                        <div class="form-group">
                            <label for="username">Käyttäjätunnus:&nbsp</label>
                            <input type="text" maxlength="50" class="form-control" name="username" value="{{$user->username}}" disabled/>
                        </div>
                        <div class="form-group">
                            <label for="email">Sähköposti:&nbsp</label>
                            <input id="email" maxlength="50" type="text" class="form-control" name="email" value="{{$user->email}}" disabled/>
                        </div>
                        <div class="form-group">
                            <label for="password">Salasana:&nbsp</label>
                            <input type="password" maxlength="50" class="form-control" name="password" value="{{$user->password}}" disabled>
                        </div>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                
            </div>
        </div>
    </div>
@endsection
