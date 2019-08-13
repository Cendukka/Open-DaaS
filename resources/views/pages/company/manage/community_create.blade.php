@extends('layouts.macrolocation')
@section('title', 'Hallinnoi: Kunnan luominen')
@section('content')
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3>Lisää kunta</h3>
            </div>
            <div class="panel-body">
                @includeWhen($errors->any(),'includes.forms.errors', ['errors' => $errors])
                <div class="form-horizontal">
                    <form method="post" class="form-text-align-padd" action="community-store" onsubmit="return confirm('Uusi kunta rekisteröidään. Haluatko jatkaa?');">
                        @csrf
                        <div class="form-group row">
                            <div class="col-sm-2">
                                <label for="city">Kunta:</label>
                            </div>
                            <div class="col-sm-10">
                                <input type="text" maxlength="50" class="form-control element-width-auto" name="city" value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-2"></div>
                            <div class="col-sm-10">
                                <div class="custom-control custom-checkbox my-1 mr-sm-2">
                                    <input type="checkbox" class="custom-control-input" id="is_disabled" name="is_disabled">
                                    <label class="custom-control-label" for="is_disabled">Poistettu käytöstä</label>
                                </div>
                            </div>
                        </div>
                        @include('includes.forms.buttons', ['submit' => 'Lisää', 'cancel' => url('/companies/'.$company->company_id.'/manage/communities')])
                    </form>
                </div>
            </div>
        </div>
@endsection
