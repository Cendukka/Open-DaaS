@extends('layouts.default')
@section('content')
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
                    <h4>Edit a material name:</h4>
                    <form method="post" action="materials-update">
                        @csrf
                        <div class="form-group">
                            <label for="name">Material Name: </label>
                            <input type="text" class="form-control" name="name" value="{{$material->material_name}}"/>
                        </div>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection