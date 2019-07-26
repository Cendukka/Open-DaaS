@extends('layouts.default')
@section('content')
<div id="content2" class="row">
    <div class="panel panel-default">
        <div class="panel-heading" >
            <h2>Yhtiön rekisteröinti lomake</h2>
        </div>

        <div class="panel-body">

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li STYLE="text-align:left;">{{ $error }}</li>
                        @endforeach
                        </ul>
                    </div>
                    @endif

            <div class="form-horizontal">
                <form method="post" action="company-store" onsubmit="return confirm('Uusi organisaatio rekisteröidään. Haluatko jatkaa?');">
                @csrf
                    <div class="form-group row">
                        <label for="companyName" class="col-sm-2 col-form-label text-left">Yhtiön nimi</label>
                        <div class="col-sm-4">
                            <input type="text" name="name" placeholder="Yhtiön nimi" class="form-control" autofocus>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="companyAdd" class="col-sm-2 col-form-label text-left">Katuosoite</label>
                        <div class="col-sm-4">
                            <input type="text" name="address" placeholder="Katuosoite" class="form-control" autofocus>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="companyPostalCode" class="col-sm-2 col-form-label text-left">Postinumero</label>
                        <div class="col-sm-4">
                            <input  type="text" name="postal_code" placeholder="Postinumero" class="form-control" >
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="companyCity" class="col-sm-2 col-form-label text-left">Kaupunki</label>
                        <div class="col-sm-4">
                            <input type="text" name="city" placeholder="Kaupunki" class="form-control">
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-2">
                            <button type="submit"  class="btn btn-primary">Rekisteröi</button>
                            <button id="cancel" type="button" class="btn btn-primary" onclick="location.href='{{url()->previous()}}';">Peruuta</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>

@endsection
