
{{--Form for editing material record--}}

@extends('layouts.default')
@section('title', 'Hallinnoi: Materiaalin muokkaus')
@section('content')
    <div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3>Muokkaa materiaalia </h3>
            </div>
            <div class="panel-body">
                @includeWhen($errors->any(),'includes.forms.errors', ['errors' => $errors])
                <div class="form-horizontal">
                    <form method="post" action="materials-update" onsubmit="return confirm('Oletko varma, että haluat päivittää materiaalin?');">
                        @csrf
                        <div class="form-group row">
                            <div class="col-sm-2 text-left">
                                <label for="name">Materiaalin nimi:</label><br>
                            </div>

                            <div class="col-sm-10 text-left">
                                <input type="text" class="form-control element-width-auto" name="name" value="{{$material->material_name}}"/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-2 text-left">
                                <label for="type">Materiaalin tyyppi:</label>
                            </div>
                            <div class="col-sm-10 text-left">
                                <select name="type" class="form-control element-width-auto">
                                    <option {{'raw waste' == $material->material_type ? 'selected="selected"' : ''}} value="raw waste">Lajittelematon</option>
                                    <option {{'refined' == $material->material_type ? 'selected="selected"' : ''}} value="refined">Jatkolajiteltu</option>
                                    <option {{'presorted' == $material->material_type ? 'selected="selected"' : ''}} value="presorted">Esilajiteltu</option>
                                    <option {{'textile' == $material->material_type ? 'selected="selected"' : ''}} value="textile">Kierrätyskelpoinen</option>
                                    <option {{'retired' == $material->material_type ? 'selected="selected"' : ''}} value="retired">Ei käytössä</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-5">
                                @include('includes.forms.buttons', ['submit' => 'Tallenna', 'cancel' => url('/materials')])
                            </div>
                        </div>
                    </form>
                    <form method="post" action="materials-destroy" onsubmit="return confirm('Oletko varma, että haluat poistaa materiaalin?');">
                        <div class="element-float-right">
                        @csrf
                        @if (!(count($material->inventory)>0 || count($material->receipt)>0 || count($material->detail)>0 || count($material->refined)>0))
                            <button type="submit" class="btn btn-primary ">Poista</button>
                        @else
                            <button type="submit" class="btn btn-secondary " disabled>Poista</button>
                        @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
