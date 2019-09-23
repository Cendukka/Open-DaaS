
{{--Form for editing community record --}}

@extends('layouts.macrolocation')
@section('title', 'Hallinnoi: Kunnan muokkaus')
@section('content')
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3>Muokkaa kuntaa </h3>
            </div>
            <div class="panel-body">
                @includeWhen($errors->any(),'includes.forms.errors', ['errors' => $errors])
                <div class="form-horizontal">
                    <form method="post" class="form-text-align-padd" action="community-update">
                        @csrf
                        <div class="form-group row">
                            <div class="col-sm-2">
                                <label for="city">*Kunta:</label>
                            </div>
                            <div class="col-sm-10">
                                <input type="text" maxlength="50" class="form-control element-width-auto" name="city" value="{{title_case($community->community_city)}}">
                            </div>
                        </div>
                        @include('includes.forms.is_disabled', ['is_disabled' => $community->is_disabled])
                        @include('includes.forms.buttons', ['submit' => 'Tallenna', 'cancel' => url('/companies/'.$company->company_id.'/manage/communities')])
                    </form>
                </div>
            </div>
        </div>
@endsection
