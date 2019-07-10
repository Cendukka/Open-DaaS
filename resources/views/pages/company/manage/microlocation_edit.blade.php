@extends('layouts.macrolocation')
@section('content')
    <div id="content2" class="row">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3>Muokkaa microlokaatiota </h3>
            </div>
            <div>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @php
                    $microlocations = DB::table('microlocations')
                                ->where('microlocation_company_id','=',$company->company_id)
                                ->where('microlocation_id','=',$microlocation->microlocation_id)
                                ->orderBy('microlocation_id')
                                ->get();
                @endphp
                @if(count($microlocations)==0)
                    <h4>Microlocation not found</h4>
                @else
                    <form method="post" action="microlocations-update" style="padding: 2% 0% 2% 2%;">
                        @csrf
                        <div class="form-group">
                            <label for="company">Yhtiö:&nbsp</label>
                            <select class="form-control" name="company">
                                <option selected="selected" hidden value="{{$company->company_id}}">{{title_case($company->company_name)}}</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="type">Microlokaation tyyppi:&nbsp</label>
                            <select class="form-control" name="type">
                                @php
                                    $types = DB::table('microlocation_types')->get();
                                @endphp
                                @foreach ($types as $type)
                                    <option {{$type->microlocation_type_id == $microlocation->microlocation_type_id ? 'selected="selected"' : ''}} value="{{$type->microlocation_type_id}}">{{title_case($type->microlocation_typename)}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="name">Microlocation Name:&nbsp</label>
                            <input type="text" maxlength="191" class="form-control" name="name" value="{{title_case($microlocation->microlocation_name)}}"/>
                        </div>
                        <div class="form-group">
                            <label for="address">Street Address:&nbsp</label>
                            <input type="text" maxlength="191" class="form-control" name="address" value="{{title_case($microlocation->microlocation_street_address)}}"/>
                        </div>
                        <div class="form-group">
                            <label for="postal_code">Postal Code:&nbsp</label>
                            <input type="text" maxlength="5"  class="form-control" name="postal_code" value="{{title_case($microlocation->microlocation_postal_code)}}"/>
                        </div>
                        <div class="form-group">
                            <label for="city">City:&nbsp</label>
                            <input type="text" maxlength="50" class="form-control" name="city" value="{{title_case($microlocation->microlocation_city)}}">
                        </div>
                        <button type="submit" class="btn btn-primary">Tallenna</button>
                    </form>
                @endif
            </div>
        </div>
    </div>
@endsection
