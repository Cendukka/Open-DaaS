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
                    <h4>Add Microlocation</h4>
                    <form method="post" action="microlocations-store">
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
                                    <option value="{{$type->microlocation_type_id}}">{{title_case($type->microlocation_typename)}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="name">Microlocation Name: </label>
                            <input type="text" class="form-control" name="name"/>
                        </div>
                        <div class="form-group">
                            <label for="address">Street Address: </label>
                            <input type="text" class="form-control" name="address"/>
                        </div>
                        <div class="form-group">
                            <label for="postal_code">Postal Code: </label>
                            <input type="text" class="form-control" name="postal_code"/>
                        </div>
                        <div class="form-group">
                            <label for="password">City: </label>
                            <input type="text" class="form-control" name="city" value="{{$company->company_city}}">
                        </div>
                        <br>
                        <button type="submit" class="btn btn-primary">Add</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection