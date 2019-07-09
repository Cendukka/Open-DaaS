@extends('layouts.default')
@section('content')
    <div id="content2" class="row">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3>Lisää uusi materiaali </h3>
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
                
                <div style="justify-content: center;">
                <form method="post" action="materials-store" onsubmit="return confirm('New material is being added. Do you like to proceed?');">
                    @csrf
                    <div class="form-group">
                         <label for="name">Materiaalin nimi: </label> </div>
                        <div> <input type="text" class="form-control center" name="name"/></div>
                    </div>
                    <br>
                    <button type="submit" class="btn btn-primary">Lisää</button>
                </form>
            </div>
         </div>
        </div>
    </div>
@endsection
