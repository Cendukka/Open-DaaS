@extends('layouts.macrolocation')
@section('title', 'Hallinnoi: Hienolajittelun muokkaus')
@section('content')
    <div id="content2" class="row">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3>Muokkaa hienolajittelu kirjausta </h3>
            </div>
            <div class="panel-body">
                @includeWhen($errors->any(),'includes.forms.errors', ['errors' => $errors])
                <form method="post" action="refined-update" class="form-text-align-padd">
                    @csrf
                    @include('includes.forms.created_modified', ['created_at' => $refined->created_at, 'updated_at' => $refined->updated_at])
                    @include('includes.forms.datetime',     ['time' => $refined->refined_date])
                    @php
                        $origin = ($refined->pre_sorting_id ? 'presorted' : ($refined->refined_receipt_id ? 'receipt' : 'error'));
                        if($origin == 'presorted'){
                            $ml_id = DB::table('pre_sorting')
                            ->join('inventory_receipt','pre_sorting_receipt_id','receipt_id')
                            ->where('pre_sorting_id','=',$refined->pre_sorting_id)
                            ->first()->receipt_to_microlocation_id;
                        }
                        elseif($origin == 'receipt'){
                            $ml_id = $query = DB::table('inventory_receipt')
                            ->where('receipt_id','=',$refined->refined_receipt_id)
                            ->first()->receipt_to_microlocation_id;
                        }
                        else{
                            $ml_id = 0;
                        }
                    @endphp
                    @include('includes.forms.users',        ['users' => DB::table('users')->where('user_company_id','=',$company->company_id)->orderBy('last_name')->get(), 'selected_user_id' => $refined->refined_user_id])
                    @include('includes.forms.microlocation',['microlocations' => DB::table('microlocations')->where('microlocation_company_id','=',$company->company_id)->get(), 'selected_microlocation_id' => $ml_id, 'tag' => 'microlocation', 'name' => 'Microlokaatio:', 'disabled' => Auth::user()->user_type_id > 2])
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="origin">Tekstiilin alkuperä:</label>
                        <div class="col-sm-10">
                            <select class="form-control element-width-auto form-field-width" name="origin" id="origin">
                                <option selected="selected" disabled hidden value=""></option>
                                <option value="presort" {{$origin == 'presorted' ? 'selected="selected"' : ''}}>Esilajittelu</option>
                                <option value="receipt" {{$origin == 'receipt' ? 'selected="selected"' : ''}}>Saapuneet</option>
                            </select>
                        </div>
                    </div>
                    <div id="originSelect" class="form-group row">

                    </div>
                    @include('includes.forms.materials',    ['materials' => DB::table('material_names')->where('material_type','=','textile')->get(), 'selected_material_id' => $refined->refined_material_id])
                    @include('includes.forms.weight', ['weight' => $refined->refined_weight])
                    @include('includes.forms.description', ['description' => $refined->description])
                    @include('includes.forms.buttons', ['submit' => 'Tallenna', 'cancel' => url('/companies/'.$company->company_id.'/refined')])
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
            var $pre_receipt_id = '{{($refined->refined_receipt_id ?: $refined->pre_sorting_id)}}';
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
