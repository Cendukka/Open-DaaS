
{{--Form for editing microlocation record--}}

@extends('layouts.macrolocation')
@section('title', 'Hallinnoi: Toimipisteen muokkaus')
@section('content')
    <div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3>Muokkaa toimipistettä </h3>
            </div>
            <div class="panel-body">
                @includeWhen($errors->any(),'includes.forms.errors', ['errors' => $errors])
                    <form method="post" action="microlocations-update" class="form-text-align-padd">
                        @csrf
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Organisaatio:</label></label>
                            <div class="col-sm-10">
                                <label class="col-form-label">{{title_case($company->company_name)}}</label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" for="type">Toimipisteen tyyppi:</label>
                            <div class="col-sm-10">
                                <select class="form-control element-width-auto form-field-width" name="type">
                                    <option selected="selected" hidden disabled value=""></option>
                                    @foreach (DB::table('microlocation_types')->get() as $type)
                                        <option {{$type->microlocation_type_id == $microlocation->microlocation_type_id ? 'selected="selected"' : ''}} value="{{$type->microlocation_type_id}}">{{title_case($type->microlocation_typename)}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" for="name">Toimipisteen nimi</label>
                            <div class="col-sm-10">
                                <input type="text" maxlength="191" class="form-control element-width-auto form-field-width" name="name" value="{{title_case($microlocation->microlocation_name)}}"/>
                                <small class="form-text text-muted">
                                    Valitse, toimipisteelle joku kuvaava nimi, mistä sen tunnistaa helposti.
                                </small>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" for="address">Katuosoite:</label>
                            <div class="col-sm-10">
                                <input type="text" maxlength="191" class="form-control element-width-auto form-field-width" name="address" value="{{title_case($microlocation->microlocation_street_address)}}"/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" for="postal_code">Postinumero:</label>
                            <div class="col-sm-10">
                                <input type="text" maxlength="5" class="form-control element-width-auto form-field-width" name="postal_code" value="{{title_case($microlocation->microlocation_postal_code)}}"/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" for="city">Kaupunki:</label>
                            <div class="col-sm-10">
                                <input type="text" maxlength="50" class="form-control element-width-auto form-field-width" name="city" value="{{title_case($microlocation->microlocation_city)}}"/>
                            </div>
                        </div>
                        @include('includes.forms.is_disabled', ['is_disabled' => $microlocation->is_disabled])
                        @include('includes.forms.buttons', ['submit' => 'Tallenna', 'cancel' => url('/companies/'.$company->company_id.'/manage/microlocations')])
                    </form>
            </div>
        </div>
    </div>
@endsection
