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
                    <br>
                    @if (!(count($material->inventory)>0 || count($material->receipt)>0 || count($material->detail)>0 || count($material->refined)>0))
                    <form method="post" action="materials-destroy">
                        @csrf
                        <button type="submit" class="btn btn-primary">Delete</button>
                    </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection