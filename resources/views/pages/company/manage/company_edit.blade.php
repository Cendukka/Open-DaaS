@extends('layouts.macrolocation')
@section('title', 'Hallinnoi: Organisaation muokkaus')
@section('content')
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3>Muokkaa organisaatiota</h3>
            </div>
            <div class="panel-body">
                @includeWhen($errors->any(),'includes.forms.errors', ['errors' => $errors])
                <div class="form-horizontal">
                    <form method="post" action="company-update" class="text-left">
                        @csrf
                        <div class="form-group row">
                            <div class="col-sm-2">
                                <label for="name">Organisaation nimi:</label>
                            </div>
                            <div class="col-sm-10">
                                <input type="text" maxlength="191" class="form-control element-width-30" name="name" value="{{$company->company_name}}"/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-2">
                                <label for="address">Katuosoite:</label>
                            </div>
                            <div class="col-sm-10">
                                <input type="text" maxlength="191" class="form-control element-width-30" name="address" value="{{$company->company_street_address}}"/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-2">
                                <label for="postal_code">Postinumero:</label>
                            </div>
                            <div class="col-sm-10">
                                <input type="text" maxlength="5"  class="form-control element-width-30" name="postal_code" value="{{$company->company_postal_code}}"/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-2">
                                <label for="city">Kaupunki:</label>
                            </div>
                            <div class="col-sm-10">
                                <input type="text" maxlength="50" class="form-control element-width-30" name="city" value="{{$company->company_city}}">
                            </div>
                        </div>
                        @include('includes.forms.buttons', ['submit' => 'Tallenna', 'cancel' => url('/companies/'.$company->company_id)])
                    </form>
                </div>
            </div>
        </div>
@endsection
