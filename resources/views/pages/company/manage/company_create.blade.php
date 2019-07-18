@extends('layouts.default')
@section('content')
    <div id="content" class="row">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3>Create a new Company </h3>
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
                <form method="post" action="company-store">
                    @csrf
                    <div class="form-group">
                        <label for="name">Company Name:&nbsp</label>
                        <input type="text" maxlength="191" class="form-control" name="name"/>
                    </div>
                    <div class="form-group">
                        <label for="address">Street Address:&nbsp</label>
                        <input type="text" maxlength="191" class="form-control" name="address"/>
                    </div>
                    <div class="form-group">
                        <label for="postal_code">Postal Code:&nbsp</label>
                        <input type="text" maxlength="5" class="form-control" name="postal_code"/>
                    </div>
                    <div class="form-group">
                        <label for="city">City:&nbsp</label>
                        <input type="text" maxlength="50" class="form-control" name="city">
                    </div>
                    <button type="submit" class="btn btn-primary">Add</button>
                    <button id="cancel" type="button" class="btn" onclick="location.href='{{url()->previous()}}';">Cancel</button>
                </form>
            </div>
        </div>
    </div>
@endsection