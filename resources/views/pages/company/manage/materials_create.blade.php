@extends('layouts.default')
@section('title', 'Hallinnoi: Materiaalin luominen')
@section('content')
    <div id="content2" class="row">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3>Lisää uusi materiaali </h3>
            </div>
            <div class="panel-body">
                <div class="form-horizontal">
                    @includeWhen($errors->any(),'includes.forms.errors', ['errors' => $errors])
                    <form method="post" action="materials-store" onsubmit="return confirm('Oletko varma, että haluat lisätä uuden materiaalin');">
                        <div class="form-group row">
                            @csrf
                            <div class="col-sm-2 text-left">
                                <label for="name">Materiaalin nimi:</label><br>
                            </div>
                            <div class="col-sm-10">
                                <input type="text" class="form-control element-width-auto" name="name"/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-2 text-left">
                                <label for="type">Materiaalin tyyppi:</label>
                            </div>
                            <div class="col-sm-10">
                                <select name="type" class="form-control element-width-auto" >
                                    <option selected="selected" disabled hidden value=""></option>
                                    <option value="raw waste">Lajittelematon</option>
                                    <option value="refined">Jatkolajiteltu</option>
                                    <option value="presorted">Esilajiteltu</option>
                                    <option value="textile">Kierrätyskelpoinen</option>
                                    <option value="retired">Ei käytössä</option>
                                </select>
                            </div>
                        </div>
                            @include('includes.forms.buttons', ['submit' => 'Tallenna', 'cancel' => url('/materials')])
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
