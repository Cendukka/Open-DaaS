@extends('layouts.macrolocation')
@section('title', 'Create user')
@section('content')
    <div id="content2" class="row">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3>Lisää käyttäjä </h3>
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
                        <label for="user_type">Käyttäjätyyppi:&nbsp</label>
                        <select name="user_type">
                            <option value="2">Manager</option>
                            <option value="3">User</option>

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
                                <option value="{{$ml->microlocation_id}}">{{title_case($ml->microlocation_city).', '.title_case($ml->microlocation_name)}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="last_name">Last Name:&nbsp</label>
                        <input id="last_name" maxlength="50" type="text" class="form-control" name="last_name"/>
                    </div>
                    <div class="form-group">
                        <label for="first_name">First Name:&nbsp</label>
                        <input id="first_name" maxlength="50" type="text" class="form-control" name="first_name"/>
                    </div>
                    <div class="form-group">
                        <label for="username">Username:&nbsp</label>
                        <input id="username" maxlength="50" type="text" class="form-control" name="username"/>
                    </div>
                    <div class="form-group">
                        <label for="email">Email:&nbsp</label>
                        <input id="email" maxlength="50" type="text" class="form-control" name="email"/>
                    </div>
                    <div class="form-group">
                        <label for="password">Password:&nbsp</label>
                        <input type="text" maxlength="50"class="form-control" name="password" value="qwerty" disabled>
                    </div>
                    <br>
                    <button type="submit" class="btn btn-primary">Lisää</button>
                </form>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script type="text/javascript">
        function source(){
            $("#username").val($("#last_name").val()+'.'+$("#first_name").val());
            $("#email").val($("#last_name").val()+'.'+$("#first_name").val()+"@domain.test");
        };
        $('#first_name').on('change',source);
        $('#last_name').on('change',source);
    </script>
@endsection
