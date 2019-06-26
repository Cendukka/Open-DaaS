@extends('layouts.macrolocation')
@section('content')
    <div id="content2" class="row">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3>Create a microlocation </h3>
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
                <form method="post" action="microlocations-store">
                    @csrf
                    <div class="form-group">
                        <label for="company">Company:&nbsp</label>
                        <select name="company">
                            <option selected="selected" hidden value="{{$company->company_id}}">{{title_case($company->company_name)}}</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="type">Microlocation Type:&nbsp</label>
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
                        <label for="name">Microlocation Name:&nbsp</label>
                        <input type="text" class="form-control" name="name"/>
                    </div>
                    <div class="form-group">
                        <label for="address">Street Address:&nbsp</label>
                        <input type="text" class="form-control" name="address"/>
                    </div>
                    <div class="form-group">
                        <label for="postal_code">Postal Code:&nbsp</label>
                        <input type="text" class="form-control" name="postal_code"/>
                    </div>
                    <div class="form-group">
                        <label for="password">City:&nbsp</label>
                        <input type="text" class="form-control" name="city" value="{{$company->company_city}}">
                    </div>
                    <br>
                    <button type="submit" class="btn btn-primary">Add</button>
                </form>
            </div>
        </div>
    </div>
@endsection
