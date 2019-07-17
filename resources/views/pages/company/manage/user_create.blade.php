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
                <form method="post" action="users-store" class="form-text-align-padd">
                    @csrf
                    <div class="form-group">
                        <label for="user_type">Käyttäjätyyppi:</label>
                        <select class="form-control element-width-auto" name="user_type">
                            <option value="2">Yhtiön bosse</option>
                            <option value="3">Microlokaationin työntekijä</option>

                        </select>
                    </div>
                    <div class="form-group">
                        <label for="microlocation">Microlokaatio:</label>
                        <select class="form-control element-width-auto" name="microlocation">
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
                        <label for="first_name">Etunimi:</label>
                        <input id="first_name" maxlength="50" type="text" class="form-control element-width-auto" name="first_name"/>
                    </div>
                    <div class="form-group">
                        <label for="last_name">Sukunimi:</label>
                        <input id="last_name" maxlength="50" type="text" class="form-control element-width-auto" name="last_name"/>
                    </div>
                    <div class="form-group">
                        <label for="username">Käyttäjänimi:</label>
                        <input id="username" maxlength="50" type="text" class="form-control element-width-auto" name="username"/>
                    </div>
                    <div class="form-group">
                        <label for="email">Sähköposti:</label>
                        <input id="email" maxlength="50" type="text" class="form-control text-lowercase element-width-auto" name="email"/>
                    </div>
                    <div class="form-group">
                        <label for="password">Salasana:</label>
                        <input type="text" maxlength="50"class="form-control element-width-auto" name="password" value="qwerty" disabled>
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
            $("#username").val($("#first_name").val()+'.'+$("#last_name").val());
            $("#email").val($("#first_name").val()+'.'+$("#last_name").val()+"@testdomain.fi");
        };
        $('#first_name').on('change',source);
        $('#last_name').on('change',source);

        function microlocation(){
            var $userType = $("#user_type").val();
            if($userType > 2){ // Transport
                $("#microlocation").show();
            }
            else{
                $("#microlocation").hide();
            }
        };
        $(document).ready(microlocation);
        $('#user_type').on('change',microlocation);
    </script>
@endsection
