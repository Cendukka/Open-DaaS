@extends('layouts.macrolocation')
@section('content')
    <div id="content2" class="row">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3>Lisää microlokaatio </h3>
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
                <form method="post" action="microlocations-store" class="form-text-align-padd">
                    @csrf
                    <div class="form-group">
                        <label for="company">Yhtiö:</label>
                        <select class="form-control element-width-auto" name="company">
                            <option selected="selected" hidden value="{{$company->company_id}}">{{title_case($company->company_name)}}</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="type">Microlokaation tyyppi:</label>
                        <select class="form-control element-width-auto" name="type">
                            @php
                                $types = DB::table('microlocation_types')->get();
                            @endphp
                            @foreach ($types as $type)
                                <option value="{{$type->microlocation_type_id}}">{{title_case($type->microlocation_typename)}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="name">Microlokaation nimi:</label>
                        <input type="text" class="form-control element-width-auto" name="name"/>
                    </div>
                    <div class="form-group">
                        <label for="address">Katuosoite:</label>
                        <input type="text" class="form-control element-width-auto" name="address"/>
                    </div>
                    <div class="form-group">
                        <label for="postal_code">Postinumero:</label>
                        <input type="text" class="form-control element-width-auto" name="postal_code"/>
                    </div>
                    <div class="form-group">
                        <label for="password">Kaupunki:</label>
                        <input type="text" class="form-control element-width-auto" name="city" value="{{$company->company_city}}">
                    </div>
                    <br>
                    <button type="submit" class="btn btn-primary">Lisää</button>
                </form>
            </div>
        </div>
    </div>
@endsection
