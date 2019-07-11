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
                        <label for="user">User:&nbsp</label>
                        <select name="user">
                            @foreach (DB::table('users')->where('user_company_id','=',$company->company_id)->orderBy('last_name')->get() as $user)
                                <option value="{{$user->user_id}}">{{title_case($user->last_name.' '.$user->first_name)}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="datetime">Date & Time:&nbsp</label>
                        <div style="position: relative">
                            <input type="text" class="form-control timepicker" name="datetime" id="datetime" name="to-date" value="{{date('Y-m-d')}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="material">Material:&nbsp</label>
                        <select name="material">
                            <option selected="selected" disabled hidden value=""></option>
                            @foreach (DB::table('material_names')->whereIn('material_type',['textile','raw waste','refined'])->get() as $material)
                                <option value="{{$material->material_id}}">{{title_case($material->material_name)}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="source">Source:&nbsp</label>
                        <select id="source" name="source">
                            <option value="internal">Internal</option>
                            <option value="external">External</option>
                            <option value="supplier">Supplier</option>
                        </select>
                    </div>
                    <div id="from" class="form-group">
                        <label for="from_microlocation">From microlocation:&nbsp</label>
                        <select name="from_microlocation">
                            <option value="" selected="selected" hidden disabled></option>
                            @foreach (DB::table('microlocations')->where('microlocation_company_id','=',$company->company_id)->get() as $ml)
                                <option value="{{$ml->microlocation_id}}">{{title_case($ml->microlocation_name)}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="to_microlocation">To microlocation:&nbsp</label>
                        <select name="to_microlocation">
                            <option selected="selected" disabled hidden value=""></option>
                            @foreach (DB::table('microlocations')->where('microlocation_company_id','=',$company->company_id)->get() as $ml)
                                <option value="{{$ml->microlocation_id}}">{{title_case($ml->microlocation_name)}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="weight">Weight (kg):&nbsp</label>
                        <input type="text" class="form-control" name="weight"/>
                    </div>
                    <div class="form-group">
                        <label for="distance">Disance (km):&nbsp</label>
                        <input type="text" class="form-control" name="distance"/>
                    </div>
                    <div class="form-group">
                        <label for="ewc">EWC Code:&nbsp</label>
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
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <script type="text/javascript">
        $('.timepicker').datepicker({
            format: 'yyyy-mm-dd'
        });
    </script>
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