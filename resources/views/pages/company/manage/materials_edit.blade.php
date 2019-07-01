@extends('layouts.default')
@section('content')
    <div id="content" class="row">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3>Edit a material </h3>
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
                <form method="post" action="materials-update">
                    @csrf
                    <div class="form-group">
                        <label for="name">Material Name:&nbsp</label>
                        <input type="text" class="form-control" name="name" value="{{$material->material_name}}"/>
                    </div>
                    <div class="form-group">
                        <label for="retired">Material Retired:&nbsp</label>
                        <input type="checkbox" class="form-check-input" id="retired" name="retired" {{$material->retired ? 'checked' : ''}}>
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
@endsection