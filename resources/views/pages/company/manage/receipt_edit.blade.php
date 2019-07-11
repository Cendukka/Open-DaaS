@extends('layouts.macrolocation')
@section('content')
    <div id="content" class="row">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3>Edit receipt </h3>
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
                <form method="post" action="receipts-update">
                    @csrf
                    <div class="form-group">
                        <label for="user">User:&nbsp</label>
                        <select name="user">
                            @foreach (DB::table('users')->where('user_company_id','=',$company->company_id)->orderBy('last_name')->get() as $user)
                                <option value="{{$user->user_id}}" {{($user->user_id == $receipt->receipt_user_id ? 'selected="selected"' : '')}}>{{title_case($user->last_name.' '.$user->first_name)}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Receipt created at:&nbsp</label>{{$receipt->created_at}}
                        <p></p>
                        <label>Receipt updated at:&nbsp</label>{{$receipt->updated_at}}
                    </div>
                    <div class="form-group">
                        <label for="datetime">Date & Time:&nbsp</label>
                        <div style="position: relative">
                            <input type="text" class="form-control timepicker form-control" name="datetime" value="{{$receipt->receipt_date}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="material">Material:&nbsp</label>
                        <select name="material">
                            <option selected="selected" disabled hidden value=""></option>
                            @foreach (DB::table('material_names')->whereIn('material_type',['textile','raw waste','refined'])->get() as $material)
                                <option value="{{$material->material_id}}" {{($material->material_id == $receipt->receipt_material_id ? 'selected="selected"' : '')}}>{{title_case($material->material_name)}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="source">Source:&nbsp</label>
                        <select id="source" name="source">
                            <option value="internal" {{($receipt->receipt_from_microlocation_id ? 'selected="selected"' : '')}}>Internal</option>
                            <option value="external" {{($receipt->from_community_id ? 'selected="selected"' : '')}}>External</option>
                            <option value="supplier" {{($receipt->from_supplier_id ? 'selected="selected"' : '')}}>Supplier</option>
                        </select>
                    </div>
                    <div id="from" class="form-group">
                    </div>
                    <div class="form-group">
                        <label for="to_microlocation">To microlocation:&nbsp</label>
                        <select name="to_microlocation">
                            <option selected="selected" disabled hidden value=""></option>
                            @foreach (DB::table('microlocations')->where('microlocation_company_id','=',$company->company_id)->get() as $ml)
                                <option value="{{$ml->microlocation_id}}" {{($ml->microlocation_id == $receipt->receipt_to_microlocation_id ? 'selected="selected"' : '')}}>{{title_case($ml->microlocation_name)}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="weight">Weight (kg):&nbsp</label>
                        <input type="text" class="form-control" name="weight" value="{{$receipt->receipt_weight}}"/>
                    </div>
                    <div class="form-group">
                        <label for="distance">Disance (km):&nbsp</label>
                        <input type="text" class="form-control" name="distance" value="{{$receipt->distance_km}}"/>
                    </div>
                    <div class="form-group">
                        <label for="ewc">EWC Code:&nbsp</label>
                        <select name="ewc">
                            @foreach (DB::table('ewc_codes')->get() as $ewc)
                                <option value="{{$ewc->ewc_code}}" {{($ewc->ewc_code== $receipt->receipt_ewc_code ? 'selected="selected"' : '')}}>{{title_case($ewc->ewc_code)}}</option>
                            @endforeach
                        </select>
                    </div>
                    <br>
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>
    <script type="text/javascript">
        function source(){
            $source = $("#source").val();
            $ml_id = {{$receipt->receipt_from_microlocation_id ?: 0}}
            $community_id = {{$receipt->from_community_id ?: 0}}
            $supplier_id = {{$receipt->from_supplier_id ?: 0}}
            $.ajax({
                type: "get",
                url: '{{URL::to(trim(url()->current(),'/').'/source')}}',
                data: {'source':$source,'ml_id':$ml_id,'community_id':$community_id,'supplier_id':$supplier_id},
                success:function(data){
                    $("#from").empty().html(data);
                }
            })
        };
        function communities(){
            $from_company = $("#from_company").val();
            $community_id = {{$receipt->from_community_id ?: 0}}
            if($community_id!=0) {
                $.ajax({
                    type: "get",
                    url: '{{URL::to(trim(url()->current(),'/').'/communities')}}',
                    data: {'from_company': $from_company, 'community_id': $community_id},
                    success: function (data) {
                        $("#from_community").empty().html(data);
                    }
                })
            }
        };

        $(document).ready(source);
        $('#source').on('change',source);
        $(document).ready(communities);
        $(document).on("change", '#from_company', communities);
    </script>
    <script type="text/javascript">
        $('.timepicker').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss'
        });
    </script>
@endsection