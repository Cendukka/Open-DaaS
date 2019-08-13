@extends('layouts.macrolocation')
@section ('title', 'Hallinnoi: Muokkaa käyttäjää')
@section('content')
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3>Muokkaa käyttäjää </h3>
            </div>
            <div class="panel-body">
                @includeWhen($errors->any(),'includes.forms.errors', ['errors' => $errors])
                <form method="post" action="users-update" class="form-text-align-padd">
                    @csrf
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Organisaatio:</label></label>
                        <div class="col-sm-10">
                            <label class="col-form-label">{{title_case($company->company_name)}}</label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="user_type">Käyttäjä tyyppi:</label>
                        <div class="col-sm-10">
                            <select class="form-control element-width-auto form-field-width" name="user_type" id="user_type">
                                <option selected="selected" hidden disabled value=""></option>
                                @foreach(DB::table('user_types')->where('user_type_id','>','1')->get() as $type)
                                    <option {{($user->user_type_id == $type->user_type_id ? 'selected="selected"' : '')}} value="{{$type->user_type_id}}">{{$type->user_typename}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row" >
                        <label class="col-sm-2 col-form-label" for="microlocation">Toimipiste:</label>
                        <div class="col-sm-10">
                            <select class="form-control element-width-auto form-field-width" name="microlocation" id="microlocation">
                                <option selected="selected" hidden disabled value=""></option>
                                @foreach (DB::table('microlocations')->where('microlocation_company_id','=',$company->company_id)->get() as $ml)
                                    <option {{($ml->microlocation_id == $user->user_microlocation_id ? 'selected="selected"' : '')}} value="{{$ml->microlocation_id}}">{{title_case($ml->microlocation_city).', '.title_case($ml->microlocation_name)}}</option>
                                @endforeach
                            </select>
                            <label id="toimisto" class="col-form-label">Toimisto</label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="first_name">Etunimi:</label>
                        <div class="col-sm-10">
                            <input type="text" maxlength="50" class="form-control element-width-auto form-field-width" name="first_name" value="{{title_case($user->first_name)}}"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="last_name">Sukunimi:</label>
                        <div class="col-sm-10">
                            <input type="text" maxlength="50" class="form-control element-width-auto form-field-width" name="last_name" value="{{title_case($user->last_name)}}"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="username">Käyttäjätunnus:</label>
                        <div class="col-sm-10">
                            <input type="text" maxlength="50" class="form-control element-width-auto form-field-width" name="username" value="{{$user->username}}" disabled/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="email">Sähköposti:</label>
                        <div class="col-sm-10">
                            <input type="text" maxlength="50" class="form-control element-width-auto form-field-width" name="email" value="{{$user->email}}" disabled/>
                        </div>
                    </div>
                    @include('includes.forms.buttons', ['submit' => 'Tallenna', 'cancel' => url('/companies/'.$company->company_id.'/manage/users')])
                </form>
            </div>
        </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script type="text/javascript">
        function microlocation(){
            var $userType = $("#user_type").val();
            if($userType < 3 && $userType != null){
                $("#microlocation").hide();
                $("#toimisto").show();
            }
            else{
                $("#microlocation").show();
                $("#toimisto").hide();
            }
        };
        $(document).ready(microlocation);
        $('#user_type').on('change',microlocation);
    </script>
@endsection
