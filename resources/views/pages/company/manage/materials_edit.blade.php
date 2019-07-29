@extends('layouts.default')
@section('content')
    <div id="content2" class="row">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3>Muokkaa materiaalia </h3>
            </div>
            <div class="panel-body">
                @includeWhen($errors->any(),'includes.forms.errors', ['errors' => $errors])
                <div class="form-horizontal">
                    <form method="post" action="materials-update" onsubmit="return confirm('Are you sure you want to update?');">
                        @csrf
                        <div class="form-group row">
                            <div class="col-sm-2">
                                <label for="name">Materiaalin nimi:</label><br>
                            </div>

                            <div class="col-sm-10 text-left">
                                <input type="text" class="form-control center element-width-auto" name="name" value="{{$material->material_name}}"/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="form-group text-left">
                                <label for="type">Materiaalin tyyppi:</label>
                                <select name="type" class="form-control element-width-auto">
                                    <option {{'raw waste' == $material->material_type ? 'selected="selected"' : ''}} value="raw waste">Lajittelematon</option>
                                    <option {{'refined' == $material->material_type ? 'selected="selected"' : ''}} value="refined">Jatkolajiteltu</option>
                                    <option {{'presorted' == $material->material_type ? 'selected="selected"' : ''}} value="presorted">Esilajiteltu</option>
                                    <option {{'textile' == $material->material_type ? 'selected="selected"' : ''}} value="textile">Kierrätyskelpoinen</option>
                                    <option {{'retired' == $material->material_type ? 'selected="selected"' : ''}} value="retired">Ei käytössä</option>
                                </select>
                            </div>
                            @include('includes.forms.buttons', ['submit' => 'Tallenna', 'cancel' => url('/materials')])
                        </div>
                    </form>
                    <form method="post" action="materials-destroy" onsubmit="return confirm('Are you sure you want to delete?');">
                        <div class="element-float-left">
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
