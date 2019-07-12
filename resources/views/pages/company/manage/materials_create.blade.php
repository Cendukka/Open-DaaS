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
                    <div class="form-group text-left">
                         <label for="name">Materiaalin nimi:</label><br>
                        <input type="text" class="form-control center element-width-auto" name="name"/>
                    </div>
                    <div class="form-group text-left">
                        <label for="type">Materiaalin tyyppi:</label>
                        <select name="type" class="form-control element-width-auto" >
                            <option selected="selected" disabled hidden value=""></option>
                            <option value="raw waste">Lajittelematon</option>
                            <option value="refined">Jatkolajiteltu</option>
                            <option value="presorted">Esilajiteltu</option>
                            <option value="textile">Kierrätyskelpoinen</option>
                            <option value="retired">Ei käytössä</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary element-float-left" >Lisää</button>
                </form>
            </div>
         </div>
        </div>
    </div>
@endsection
