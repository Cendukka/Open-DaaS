@extends('layouts.macrolocation')
@section('title', 'Hallinnoi: Toimipisteen luominen')
@section('content')
    <div id="content2" class="row">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3>Lisää toimipiste </h3>
            </div>
            <div class="panel-body">
                @includeWhen($errors->any(),'includes.forms.errors', ['errors' => $errors])
                <form method="post" action="microlocations-store" class="form-text-align-padd" onsubmit="return confirm('Uusi toimipiste lisätään organisaatioon. Haluatko jatkaa?');">

                    @csrf
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Organisaatio:</label></label>
                        <div class="col-sm-10">
                            <label class="col-form-label">{{title_case($company->company_name)}}</label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="type">Toimipisteen tyyppi</label>
                        <div class="col-sm-10">
                            <select class="form-control element-width-auto form-field-width" name="type">
                                <option selected="selected" hidden disabled value=""></option>
                                @foreach (DB::table('microlocation_types')->get() as $type)
                                    <option value="{{$type->microlocation_type_id}}">{{title_case($type->microlocation_typename)}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="name">Toimipisteen nimi:</label>
                        <div class="col-sm-10">
                            <input type="text" maxlength="191" class="form-control element-width-auto form-field-width" name="name"/>
                            <small class="form-text text-muted">
                                Valitse, toimipisteelle joku kuvaava nimi, mistä sen tunnistaa helposti.
                            </small>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="address">Katuosoite:</label>
                        <div class="col-sm-10">
                            <input type="text" maxlength="191" class="form-control element-width-auto form-field-width" name="address"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="postal_code">Postinumero:</label>
                        <div class="col-sm-10">
                            <input type="text" maxlength="5" class="form-control element-width-auto form-field-width" name="postal_code"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="city">Kaupunki:</label>
                        <div class="col-sm-10">
                            <input type="text" maxlength="50" class="form-control element-width-auto form-field-width" name="city"/>
                        </div>
                    </div>
                    @include('includes.forms.buttons', ['submit' => 'Lisää', 'cancel' => url('/companies/'.$company->company_id.'/manage/microlocations')])
                </form>
            </div>
        </div>
    </div>
@endsection
