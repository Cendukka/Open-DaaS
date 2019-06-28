@extends('layouts.default')
@section('content')
    <div id="content2" class="row">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3>Muokkaa materiaalia </h3>
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

                        <label for="name">Materiaalin nimi:&nbsp</label>
                        <input type="text" class="form-control" name="name" value="{{$material->material_name}}"/>

                    </div>
                    <button type="submit" class="btn btn-primary">Tallenna</button>
                </form>
                <br>
                @if (!(count($material->inventory)>0 || count($material->receipt)>0 || count($material->detail)>0 || count($material->refined)>0))
                <form method="post" action="materials-destroy">
                    @csrf
                    <button type="submit" class="btn btn-primary">Poista</button>
                </form>
                @endif
            </div>
        </div>
    </div>
@endsection
