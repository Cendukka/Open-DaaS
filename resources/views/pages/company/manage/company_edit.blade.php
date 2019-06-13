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
                    <h4>Edit company information:</h4>
                    <form method="post" action="company-update">
                        @csrf
                        <div class="form-group">
                            <label for="name">Company Name: </label>
                            <input type="text" class="form-control" name="name" value="{{$company->company_name}}"/>
                        </div>
                        <div class="form-group">
                            <label for="address">Street Address: </label>
                            <input type="text" class="form-control" name="address" value="{{$company->company_street_address}}"/>
                        </div>
                        <div class="form-group">
                            <label for="postal_code">Postal Code: </label>
                            <input type="text" class="form-control" name="postal_code" value="{{$company->company_postal_code}}"/>
                        </div>
                        <div class="form-group">
                            <label for="city">City: </label>
                            <input type="text" class="form-control" name="city" value="{{$company->company_city}}">
                        </div>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection