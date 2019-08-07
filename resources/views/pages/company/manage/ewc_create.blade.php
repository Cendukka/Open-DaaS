@extends('layouts.default')
@section('title', 'Hallinnoi: EWC Koodin luominen')
@section('content')
    <div id="content" class="row">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3>Create EWC Code </h3>
            </div>
            <div class="panel-body">
                @includeWhen($errors->any(),'includes.forms.errors', ['errors' => $errors])
                <form method="post" action="ewc-store">
                    @csrf
                    <div class="form-group">
                        <label for="ewc_code">EWC Code:&nbsp</label>
                        <input type="text" class="form-control" maxlength="6" name="ewc_code"/>
                    </div>
                    <div class="form-group">
                        <label for="description">Description:&nbsp</label>
                        <textarea type="text" class="form-control" rows="8" maxlength="191" name="description"></textarea>
                    </div>
                    @include('includes.forms.buttons', ['submit' => 'Lisää', 'cancel' => url('/ewc')])
                </form>
            </div>
        </div>
    </div>
@endsection