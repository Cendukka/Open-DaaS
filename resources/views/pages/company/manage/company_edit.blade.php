@extends('layouts.macrolocation')
@section('content')
    <div id="content2" class="row">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3>Muokkaa organisaatiota</h3>
            </div>
            <div class="panel-body">
                @includeWhen($errors->any(),'includes.forms.errors', ['errors' => $errors])
                <form method="post" action="company-update" class="text-left">
                    @csrf
                    <div class="form-group row">
                        <div class="col-sm-2">
                            <label for="name">Organisaation nimi:</label>
                        </div>
                        <div class="col-sm-4">
                            <input type="text" maxlength="191" class="form-control" name="name" value="{{$company->company_name}}"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-2">
                            <label for="address">Katuosoite:</label>
                        </div>
                        <div class="col-sm-4">
                            <input type="text" maxlength="191" class="form-control" name="address" value="{{$company->company_street_address}}"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-2">
                            <label for="postal_code">Postinumero:</label>
                        </div>
                        <div class="col-sm-4">
                            <input type="text" maxlength="5"  class="form-control" name="postal_code" value="{{$company->company_postal_code}}"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-2">
                            <label for="city">Kaupunki:</label>
                        </div>
                        <div class="col-sm-4">
                            <input type="text" maxlength="50" class="form-control" name="city" value="{{$company->company_city}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-4">
                            @include('includes.forms.buttons', ['submit' => 'Tallenna', 'cancel' => url('/companies/'.$company->company_id)])
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
