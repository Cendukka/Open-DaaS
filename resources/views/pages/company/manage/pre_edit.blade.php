@extends('layouts.macrolocation')
@section('content')
    <div id="content" class="row">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3>Edit Pre-Sorting </h3>
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
                <form method="post" action="pre-update">
                    @csrf
                    <div class="form-group">
                        <label for="user">User:&nbsp</label>
                        <select class="custom-select mr-sm-2" name="user">
                            @foreach (DB::table('users')->where('user_company_id','=',$company->company_id)->orderBy('last_name')->get() as $user)
                                <option value="{{$user->user_id}}" {{($user->user_id == $pre->pre_sorting_user_id ? 'selected="selected"' : '')}}>{{title_case($user->last_name.' '.$user->first_name)}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Pre-sorting created at:&nbsp</label>{{$pre->created_at}}
                        <p></p>
                        <label>Pre-sorting updated at:&nbsp</label>{{$pre->updated_at}}
                    </div>
                    <div class="form-group">
                        @php
                            date_default_timezone_set('Europe/Helsinki')
                        @endphp
                        <label for="datetime">Date & Time:&nbsp</label>
                        <div style="position: relative">
                            <input type="text" class="form-control timepicker form-control" name="datetime" value="{{$pre->pre_sorting_date}}">
                        </div>
                    </div>
                    @php
                        $selected_microlocation_id = DB::table('microlocations')
                            ->where('microlocation_company_id','=',$company->company_id)
                            ->where('material_name','=','Raw Waste')
                            ->where('receipt_id',$pre->pre_sorting_receipt_id)
                            ->join('inventory_receipt','receipt_to_microlocation_id','microlocation_id')
                            ->join('material_names','receipt_material_id','material_id')
                            ->select('microlocation_id')
                            ->first()->microlocation_id;
                    @endphp
                    <div class="form-group">
                        <label for="microlocation">Microlocation:&nbsp</label>
                        <select name="microlocation" id="microlocation">
                            <option selected="selected" disabled hidden value=""></option>
                            @foreach (DB::table('microlocations')->where('microlocation_company_id','=',$company->company_id)->get() as $ml)
                                <option value="{{$ml->microlocation_id}}" {{($ml->microlocation_id == $selected_microlocation_id ? 'selected="selected"' : '')}}>{{title_case($ml->microlocation_name)}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="receipt">Receipt:&nbsp</label>
                        <select name="receipt" id="receipt">
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="material">Material Output:&nbsp</label>
                        <select name="material">
                            <option selected="selected" disabled hidden value=""></option>
                            @foreach (DB::table('material_names')->whereIn('material_type',['presorted','refined'])->get() as $material)
                                <option value="{{$material->material_id}}" {{($material->material_id == $pre->pre_sorting_material_id ? 'selected="selected"' : '')}}>{{title_case($material->material_name)}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="weight">Weight (kg):&nbsp</label>
                        <input type="text" class="form-control" name="weight" value="{{$pre->pre_sorting_weight}}"/>
                    </div>
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
        $('.timepicker').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss'
        });
    </script>
    <script type="text/javascript">
        function microlocations(){
            var $ml_id = $("#microlocation").val();
            var $receipt_id = '{{$pre->pre_sorting_receipt_id}}';
            $.ajax({
                type: "get",
                url: '{{URL::to(trim(url()->current(),'/').'/receipt')}}',
                data: {'ml_id':$ml_id, 'receipt_id':$receipt_id},
                success:function(data){
                    $("#receipt").empty().html(data);
                }
            })
        };
        $(document).ready(microlocations);
        $('#microlocation').on('change',microlocations);
    </script>
@endsection