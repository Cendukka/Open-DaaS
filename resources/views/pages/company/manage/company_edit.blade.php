@extends('layouts.macrolocation')
@section('content')
    <div id="content" class="row">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3>Edit Company </h3>
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
                <form method="post" action="company-update">
                    @csrf
                    <div class="form-group">
                        <label for="name">Company Name:&nbsp</label>
                        <input type="text" class="form-control" name="name" value="{{$company->company_name}}"/>
                    </div>
                    <div class="form-group">
                        <label for="address">Street Address:&nbsp</label>
                        <input type="text" class="form-control" name="address" value="{{$company->company_street_address}}"/>
                    </div>
                    <div class="form-group">
                        <label for="postal_code">Postal Code:&nbsp</label>
                        <input type="text" class="form-control" name="postal_code" value="{{$company->company_postal_code}}"/>
                    </div>
                    <div class="form-group">
                        <label for="city">City:&nbsp</label>
                        <input type="text" class="form-control" name="city" value="{{$company->company_city}}">
                    </div>
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
@endsection