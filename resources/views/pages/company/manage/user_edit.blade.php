@extends('layouts.macrolocation')
@section ('title', 'Muokkaa käyttäjää')
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
                
                    <form method="post" action="users-update" class="form-text-align-padd">
                        @csrf
                        <div class="form-group">
                            <label for="user_type">Käyttäjä tyyppi:</label>
                            <select class="form-control element-width-auto" name="user_type">
                                @foreach(DB::table('user_types')->where('user_type_id','>','1')->get() as $type)
                                    <option {{($user->user_type_id == $type->user_type_id ? 'selected="selected"' : '')}} value="{{$type->user_type_id}}">{{$type->user_typename}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="company">Yhtiö:</label>
                            {{title_case($company->company_name)}}
                        </div>
                        <div class="form-group">
                            <label for="microlocation">Microlokaatio:</label>
                            <select class="form-control element-width-auto" name="microlocation">
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
                            <label for="last_name">Etunimi:</label>
                            <input type="text" maxlength="50" class="form-control element-width-auto" name="last_name" value="{{$user->last_name}}"/>
                        </div>
                        <div class="form-group">
                            <label for="first_name">Sukunimi:</label>
                            <input type="text" maxlength="50" class="form-control element-width-auto" name="first_name" value="{{$user->first_name}}"/>
                        </div>
                        <div class="form-group">
                            <label for="username">Käyttäjätunnus:</label>
                            <input type="text" maxlength="50" class="form-control element-width-auto" name="username" value="{{$user->username}}" disabled/>
                        </div>
                        <div class="form-group">
                            <label for="email">Sähköposti:</label>
                            <input id="email" maxlength="50" type="text" class="form-control element-width-auto text-lowercase" name="email" value="{{$user->email}}" disabled/>
                        </div>
                        <button type="submit" class="btn btn-primary">Tallenna</button>
                        <button id="cancel" type="button" class="btn" onclick="location.href='{{url()->previous()}}';">Peruuta</button>

                    </form>
                
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script type="text/javascript">
        function microlocation(){
            var $userType = $("#user_type").val();
            if($userType > 2){
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
