@extends('layouts.macrolocation')
@section('title', 'Create user')
@section('content')
    <div id="content2" class="row">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3>Lisää käyttäjä </h3>
            </div>
            <div class="panel-body">
                @includeWhen($errors->any(),'includes.forms.errors', ['errors' => $errors])
                <form method="post" action="users-store" class="form-text-align-padd" onsubmit="return confirm('Uusi käyttäjä lisätään organisaatioon. Haluatko jatkaa?');">
                    @csrf
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Organisaatio:</label></label>
                        <div class="col-sm-10">
                            <label class="col-form-label">{{title_case($company->company_name)}}</label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="user_type">Käyttäjätyyppi:</label>
                        <div class="col-sm-10">
                            <select class="form-control element-width-auto form-field-width" name="käyttäjätyyppi" id="user_type">
                                <option selected="selected" hidden disabled value=""></option>
                                @foreach(DB::table('user_types')->where('user_type_id','>','1')->get() as $type)
                                    <option value="{{$type->user_type_id}}">{{$type->user_typename}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row" >
                        <label class="col-sm-2 col-form-label" for="microlocation">Microlokaatio:</label>
                        <div class="col-sm-10">
                            <select class="form-control element-width-auto form-field-width" name="toimipiste" id="microlocation">
                                <option selected="selected" hidden disabled value=""></option>
                                @foreach (DB::table('microlocations')->where('microlocation_company_id','=',$company->company_id)->get() as $ml)
                                    <option value="{{$ml->microlocation_id}}">{{title_case($ml->microlocation_city).', '.title_case($ml->microlocation_name)}}</option>
                                @endforeach
                            </select>
                            <label id="toimisto" class="col-form-label">Toimisto</label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="first_name">Etunimi:</label>
                        <div class="col-sm-10">
                            <input id="first_name" type="text" maxlength="50" class="form-control element-width-auto form-field-width" name="etunimi"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="last_name">Sukunimi:</label>
                        <div class="col-sm-10">
                            <input id="last_name" type="text" maxlength="50" class="form-control element-width-auto form-field-width" name="sukunimi"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="username">Käyttäjätunnus:</label>
                        <div class="col-sm-10">
                            <input id="username" type="text" maxlength="50" class="form-control element-width-auto form-field-width" name="username"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="email">Sähköposti:</label>
                        <div class="col-sm-10">
                            <input id="email" type="text" maxlength="50" class="form-control element-width-auto form-field-width" name="email"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="password">Salasana:</label>
                        <div class="col-sm-10">
                            <input type="text" maxlength="50" class="form-control element-width-auto form-field-width" name="salasana" value="qwerty" disabled/>
                        </div>
                    </div>
                    @include('includes.forms.buttons', ['submit' => 'Lisää', 'cancel' => url('/companies/'.$company->company_id.'/manage/users')])
                </form>
            </div>
        </div>
    </div>
@endsection
