@extends('layouts.macrolocation')
@section('content')
    <div id="content" class="row">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3>Add receipt </h3>
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
                <form method="post" action="receipts-store">
                    @csrf
                    <div class="form-group">
                        <label for="user">User: </label>
                        <select name="user">
                            @foreach (DB::table('users')->where('user_company_id','=',$company->company_id)->orderBy('last_name')->get() as $user)
                                <option value="{{$user->user_id}}">{{title_case($user->last_name.' '.$user->first_name)}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        @php
                            date_default_timezone_set('Europe/Helsinki')
                        @endphp
                        <label for="datetime">Date & Time: </label>
                        <input type="text" class="form-control" name="datetime" value="{{date('Y-m-d H:i:s')}}"/>
                    </div>
                    <div class="form-group">
                        <label for="material">User: </label>
                        <select name="material">
                            @foreach (DB::table('material_names')->get() as $material)
                                <option value="{{$material->material_id}}">{{title_case($material->material_name)}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="source">Source: </label>
                        <select name="source">
                            <option value="internal">Internal</option>
                            <option value="external">External</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="from_microlocation">From microlocation: </label>
                        <select name="from_microlocation">
                            @foreach (DB::table('microlocations')->where('microlocation_company_id','=',$company->company_id)->get() as $ml)
                                <option value="{{$ml->microlocation_id}}">{{title_case($ml->microlocation_name)}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="to_microlocation">To microlocation: </label>
                        <select name="to_microlocation">
                            @foreach (DB::table('microlocations')->where('microlocation_company_id','=',$company->company_id)->get() as $ml)
                                <option value="{{$ml->microlocation_id}}">{{title_case($ml->microlocation_name)}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="distance">Disance (km): </label>
                        <input type="text" class="form-control" name="distance"/>
                    </div>
                    <div class="form-group">
                        <label for="weight">Weight (kg): </label>
                        <input type="text" class="form-control" name="weight"/>
                    </div>

                    <div class="form-group">
                        <label for="ewc">EWC Code: </label>
                        <select name="ewc">
                            @foreach (DB::table('ewc_codes')->get() as $ewc)
                                <option value="{{$ewc->ewc_code}}">{{title_case($ewc->ewc_code)}}</option>
                            @endforeach
                        </select>
                    </div>
                    <br>
                    <button type="submit" class="btn btn-primary">Add</button>
                </form>
            </div>
        </div>
    </div>
@endsection