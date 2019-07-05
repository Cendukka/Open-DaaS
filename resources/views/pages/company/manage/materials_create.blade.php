@extends('layouts.default')
@section('content')
    <div id="content" class="row">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3>Create a new material </h3>
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
                <form method="post" action="materials-store">
                    @csrf
                    <div class="form-group">
                        <label for="name">Material Name:&nbsp</label>
                        <input type="text" class="form-control" name="name"/>
                    </div>
                    <div class="form-group">
                        <label for="type">Material Type:&nbsp</label>
                        <select name="type">
                            <option selected="selected" disabled hidden value=""></option>
                            <option value="raw waste">Raw Waste</option>
                            <option value="refined">Refined</option>
                            <option value="presorted">Presorted</option>
                            <option value="textile">Textile</option>
                            <option value="retired">Retired</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Add</button>
                </form>
            </div>
        </div>
    </div>
@endsection