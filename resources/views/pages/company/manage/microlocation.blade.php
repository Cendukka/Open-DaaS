@extends('layouts.macrolocation')
@section('content')
    <div id="macrolocation_name" class="row">
        @include('includes.macrolocation_name',['no_navbar' => true])
    </div>
    <div id="content" class="row">
        <div class="col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
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
                        <h4>Edit Microlocation</h4>
                        <form method="post" action="microlocations-update">
                            @csrf
                            <div class="form-group">
                                <label for="company">Company: </label>
                                <select name="company">
                                    <option selected="selected" hidden value="{{$company->company_id}}">{{title_case($company->company_name)}}</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="type">Microlocation Type: </label>
                                <select name="type">
                                    @php
                                        $types = DB::table('microlocation_types')->get();
                                    @endphp
                                    @foreach ($types as $type)
                                        <option {{$type->microlocation_type_id == $microlocation->microlocation_type_id ? 'selected="selected"' : ''}} value="{{$type->microlocation_type_id}}">{{title_case($type->microlocation_typename)}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="name">Microlocation Name: </label>
                                <input type="text" class="form-control" name="name" value="{{title_case($microlocation->microlocation_name)}}"/>
                            </div>
                            <div class="form-group">
                                <label for="address">Street Address: </label>
                                <input type="text" class="form-control" name="address" value="{{title_case($microlocation->microlocation_street_address)}}"/>
                            </div>
                            <div class="form-group">
                                <label for="postal_code">Postal Code: </label>
                                <input type="text" class="form-control" name="postal_code" value="{{title_case($microlocation->microlocation_postal_code)}}"/>
                            </div>
                            <div class="form-group">
                                <label for="password">City: </label>
                                <input type="text" class="form-control" name="city" value="{{title_case($microlocation->microlocation_city)}}">
                            </div>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection