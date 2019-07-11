@extends('layouts.macrolocation')
@section('content')
    <div id="content2" class="row">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3>Create Refined Sorting </h3>
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
                <form method="post" action="refined-store">
                    @csrf
                    <div class="form-group">
                        <label for="user">User:&nbsp</label>
                        <select class="custom-select mr-sm-2" name="user">
                            @foreach (DB::table('users')->where('user_company_id','=',$company->company_id)->orderBy('last_name')->get() as $user)
                                <option value="{{$user->user_id}}">{{title_case($user->last_name.' '.$user->first_name)}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="datetime">Date & Time:&nbsp</label>
                        <div style="position: relative">
                            <input type="text" class="form-control timepicker form-control" name="datetime" value="{{date('Y-m-d H:i:s')}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="origin">Refined Waste Origin:&nbsp</label>
                        <select name="origin" id="origin">
                            <option selected="selected" disabled hidden value=""></option>
                                <option value="presort">Pre-Sorting</option>
                                <option value="receipt">Receipt</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="microlocation">Microlocation:&nbsp</label>
                        <select name="microlocation" id="microlocation">
                            <option selected="selected" disabled hidden value=""></option>
                            @foreach (DB::table('microlocations')->where('microlocation_company_id','=',$company->company_id)->get() as $ml)
                                <option value="{{$ml->microlocation_id}}">{{title_case($ml->microlocation_name)}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group" id="originSelect">

                    </div>
                    <div class="form-group">
                        <label for="material">Material:&nbsp</label>
                        <select name="material">
                            <option selected="selected" disabled hidden value=""></option>
                            @foreach (DB::table('material_names')->where('material_type','=','textile')->get() as $material)
                                <option value="{{$material->material_id}}">{{title_case($material->material_name)}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="weight">Weight (kg):&nbsp</label>
                        <input type="text" class="form-control" name="weight" value=""/>
                    </div>
                    <div class="form-group">
                        <label for="description">Description:&nbsp</label>
                        <textarea type="text" class="form-control" rows="8" maxlength="191" name="description"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Add</button>
                </form>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>
    <script type="text/javascript">
        $('.timepicker').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss'
        });
    </script>
    <script type="text/javascript">
        function origin(){
            var $origin = $("#origin").val();
            var $ml_id = $("#microlocation").val();
            var $pre_receipt_id = '0';
            if($origin && $ml_id) {
                $.ajax({
                    type: "get",
                    url: '{{URL::to(trim(url()->current(),'/').'/origin')}}',
                    data: {'origin': $origin, 'ml_id': $ml_id, 'pre_receipt_id': $pre_receipt_id},
                    success: function (data) {
                        $("#originSelect").empty().html(data);
                    }
                })
            }
        };
        $(document).ready(origin);
        $('#origin').on('change',origin);
        $('#microlocation').on('change',origin);
    </script>
@endsection
