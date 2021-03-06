
{{--Form for editing issue record--}}

@extends('layouts.macrolocation')
@section('title', 'Hallinnoi: Lähetyksen muokkaus')
@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3>Muokkaa lähetystä </h3>
        </div>
        <div class="panel-body">
            @includeWhen($errors->any(),'includes.forms.errors', ['errors' => $errors])
            <form method="post" action="issues-update" class="form-text-align-padd" onsubmit="return confirm('Lähetys-kirjausta muokataan. Haluatko jatkaa?');">
                @csrf
                @include('includes.forms.created_modified',     ['created_at' => $issue->created_at, 'updated_at' => $issue->updated_at])
                @include('includes.forms.datetime',             ['time' => date("d-m-Y",strtotime($issue->issue_date))])
                @include('includes.forms.users',                ['users' => DB::table('users')->where('user_company_id','=',$company->company_id)->orderBy('last_name')->get(), 'selected_user_id' => $issue->issue_user_id])
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label" for="type">Lähetyksen tyyppi:</label>
                    <div class="col-sm-10">
                        <select class="form-control element-width-auto form-field-width" id="type" name="type">
                            <option selected="selected" disabled hidden value=""></option>
                            @foreach (DB::table('issue_types')->orderBy('issue_typename')->get() as $issue_type)
                                <option value="{{$issue_type->issue_type_id}}" {{$issue->issue_type_id == $issue_type->issue_type_id ? 'selected="selected"' : ''}}>{{title_case($issue_type->issue_typename)}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                @include('includes.forms.microlocation',        ['microlocations' => DB::table('microlocations')->where('microlocation_company_id','=',$company->company_id)->where('is_disabled','!=',1)->get(), 'selected_microlocation_id'=> $issue->issue_from_microlocation_id,'tag' => 'from_microlocation', 'name' => 'Toimipisteestä:', 'disabled' => Auth::user()->user_type_id > 2])
                <div class="form-group row" id="to_microlocation">
                    <label class="col-sm-2 col-form-label" for="to_microlocation">Mihin toimipisteeseen:</label>
                    <div class="col-sm-10">
                        <select class="form-control element-width-auto form-field-width" name="to_microlocation" id="to_microlocation">
                            <option selected="selected" hidden disabled value=""></option>
                            @foreach (DB::table('microlocations')->where('microlocation_company_id','=',$company->company_id)->get() as $ml)
                                <option value="{{$ml->microlocation_id}}" {{($ml->microlocation_id == $issue->issue_to_microlocation_id ? 'selected="selected"' : '')}}>{{title_case($ml->microlocation_name)}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row" id="to_company">
                    <label class="col-sm-2 col-form-label" for="to_microlocation">Mihin organisaatioon:</label>
                    <div class="col-sm-10">
                        <select class="form-control element-width-auto form-field-width" name="to_company" id="to_company">
                            <option selected="selected" hidden disabled value=""></option>
                            @foreach (DB::table('company')->where('company_id','!=',$company->company_id)->where('is_disabled','!=',1)->get() as $c)
                                <option value="{{$c->company_id}}" {{($c->company_id == $issue->issue_to_company_id ? 'selected="selected"' : '')}}>{{title_case($c->company_name)}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div id="details" class="form-group">
                    @foreach (DB::table('inventory_issue_details')->where('detail_issue_id','=',$issue->issue_id)->get() as $detail)
                        @include('includes.forms.details',      ['detail' => $detail])
                    @endforeach
                </div>
                <br>
                <button id="addMat" type="button" class="btn" style="margin-bottom:10px;">Lisää materiaali</button>
                <button id="removeMat" type="button" class="btn" style="margin-bottom:10px;">Poista materiaali</button>
                <br>
                <button type="submit" class="btn btn-primary" style="margin-bottom:10px;">Tallenna</button>
                <button id="cancel" type="button" class="btn" style="margin-bottom:10px;" onclick="location.href='{{url('/companies/'.$company->company_id.'/issues')}}';">Peruuta</button>
            </form>
        </div>
    </div>
    @include('includes.issue_form_scripts')
@endsection
