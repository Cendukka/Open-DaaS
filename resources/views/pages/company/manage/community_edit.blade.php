@extends('layouts.macrolocation')
@section('content')
    <div id="content" class="row">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3>Edit a microlocation </h3>
            </div>
            <div class="panel-body">
                @includeWhen($errors->any(),'includes.forms.errors', ['errors' => $errors])
                <form method="post" action="community-update">
                    @csrf
                    <div class="form-group">
                        <label for="city">Community city:&nbsp</label>
                        <input type="text" maxlength="50" class="form-control" name="city" value="{{title_case($community->community_city)}}">
                    </div>
                    @include('includes.forms.buttons', ['submit' => 'Tallenna', 'cancel' => url('/companies/'.$company->company_id.'/manage/communities')])
                </form>
            </div>
        </div>
    </div>
@endsection