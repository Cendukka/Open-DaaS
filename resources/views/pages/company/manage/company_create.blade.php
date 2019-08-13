@extends('layouts.default')
@section('title', 'Hallinnoi: Organisaation luominen')
@section('content')
<div>
    <div class="panel panel-default">
        <div class="panel-heading" >
            <h2>Organisaation rekisteröinti lomake</h2>
        </div>

        <div class="panel-body">
            @includeWhen($errors->any(),'includes.forms.errors', ['errors' => $errors])
            <div class="form-horizontal">
                <form method="post" action="company-store" onsubmit="return confirm('Uusi organisaatio rekisteröidään. Haluatko jatkaa?');">
                @csrf
                    <div class="form-group row">
                        <label for="companyName" class="col-sm-2 col-form-label text-left">Organisaation nimi</label>
                        <div class="col-sm-4">
                            <input type="text" name="nimi" placeholder="Organisaation nimi" class="form-control" autofocus>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="companyAdd" class="col-sm-2 col-form-label text-left">Katuosoite</label>
                        <div class="col-sm-4">
                            <input type="text" name="katuosoite" placeholder="Katuosoite" class="form-control" autofocus>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="companyPostalCode" class="col-sm-2 col-form-label text-left">Postinumero</label>
                        <div class="col-sm-4">
                            <input  type="text" name="postinumero" placeholder="Postinumero" class="form-control" >
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="companyCity" class="col-sm-2 col-form-label text-left">Kaupunki</label>
                        <div class="col-sm-4">
                            <input type="text" name="kaupunki" placeholder="Kaupunki" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-2"></div>
                        <div class="col-sm-10">
                            <div class="custom-control custom-checkbox my-1 mr-sm-2">
                                <input type="checkbox" class="custom-control-input" id="is_disabled" name="is_disabled">
                                <label class="custom-control-label" for="is_disabled">Poistettu käytöstä</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-5">
                            @include('includes.forms.buttons', ['submit' => 'Rekisteröi', 'cancel' => url('/home')])
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>

@endsection
