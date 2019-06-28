@extends('layouts.macrolocation')
@section('content')
    <div id="content2" class="row">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3>Materiaalin vastaanotto</h3>
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
                        <label for="user">Käyttäjä:&nbsp</label>
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
                        <label for="datetime">Aikaleima:&nbsp</label>
                        <input type="text" class="form-control center" name="datetime" value="{{date('Y-m-d H:i:s')}}"/>
                    </div>
                    <div class="form-group">
                        <label for="material">Materiaali:&nbsp</label>
                        <select name="material">
                            <option selected="selected" disabled hidden value=""></option>
                            @foreach (DB::table('material_names')->get() as $material)
                                <option value="{{$material->material_id}}">{{title_case($material->material_name)}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="source">Lähde:&nbsp</label>
                        <select id="source" name="source">
                            <option value="internal">Sisäinen</option>
                            <option value="external">Ulkoinen</option>
                            <option value="supplier">Toimittaja</option>
                        </select>
                    </div>
                    <div id="from" class="form-group">
                        <label for="from_microlocation">Mikrolokaatiosta:&nbsp</label>
                        <select name="from_microlocation">
                            <option value="" selected="selected" hidden disabled></option>
                            @foreach (DB::table('microlocations')->where('microlocation_company_id','=',$company->company_id)->get() as $ml)
                                <option value="{{$ml->microlocation_id}}">{{title_case($ml->microlocation_name)}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="to_microlocation">Microlokaatioon:&nbsp</label>
                        <select name="to_microlocation">
                            <option selected="selected" disabled hidden value=""></option>
                            @foreach (DB::table('microlocations')->where('microlocation_company_id','=',$company->company_id)->get() as $ml)
                                <option value="{{$ml->microlocation_id}}">{{title_case($ml->microlocation_name)}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="distance">Matka (Km):&nbsp</label>
                        <input type="text" class="form-control center" name="distance"/>
                    </div>
                    <div class="form-group">
                        <label for="weight">Paino (Kg):&nbsp</label>
                        <input type="text" class="form-control center" name="weight"/>
                    </div>
                    <div class="form-group">
                        <label for="ewc">EWC-Koodi:&nbsp</label>
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).on("change", '#source', function(e) {
            $source = $("#source").val();
            $.ajax({
                type: "get",
                url: '{{URL::to(trim(url()->current(),'/').'/source')}}',
                data: {'source':$source},
                success:function(data){
                    $("#from").empty().html(data);
                }
            })
        });

        $(document).on("change", '#from_company', function(e) {
            $from_company = $("#from_company").val();
            $.ajax({
                type: "get",
                url: '{{URL::to(trim(url()->current(),'/').'/communities')}}',
                data: {'from_company':$from_company},
                success:function(data){
                    $("#from_community").empty().html(data);
                }
            })
        });
    </script>
@endsection
