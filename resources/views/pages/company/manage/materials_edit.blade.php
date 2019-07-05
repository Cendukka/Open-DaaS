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
                        <label for="type">Material Type:&nbsp</label>
                        <select name="type">
                            <option {{'raw waste' == $material->material_type ? 'selected="selected"' : ''}} value="raw waste">Raw Waste</option>
                            <option {{'refined' == $material->material_type ? 'selected="selected"' : ''}} value="refined">Refined</option>
                            <option {{'presorted' == $material->material_type ? 'selected="selected"' : ''}} value="presorted">Presorted</option>
                            <option {{'textile' == $material->material_type ? 'selected="selected"' : ''}} value="textile">Textile</option>
                            <option {{'retired' == $material->material_type ? 'selected="selected"' : ''}} value="retired">Retired</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
                <br>

                <form method="post" action="materials-destroy">
                    @csrf
                    @if (!(count($material->inventory)>0 || count($material->receipt)>0 || count($material->detail)>0 || count($material->refined)>0))
                        <button type="submit" class="btn btn-primary">Delete</button>
                        @else
                        <button type="submit" class="btn btn-secondary" disabled>Delete</button>
                    @endif
                </form>

            </div>
        </div>
    </div>
@endsection