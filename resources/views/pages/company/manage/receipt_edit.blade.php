@extends('layouts.macrolocation')
@section('title', 'Hallinnoi: Saapuneiden muokkaus')
@section('content')
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3>Muokkaa saapuneet-kirjausta </h3>
            </div>
            <div class="panel-body">
                @includeWhen($errors->any(),'includes.forms.errors', ['errors' => $errors])
                <form method="post" action="receipts-update" class="form-text-align-padd" onsubmit="return confirm('Saapunut-kirjausta muokataan. Haluatko jatkaa?');">
                    @csrf
                    @include('includes.forms.created_modified',     ['created_at' => $receipt->created_at, 'updated_at' => $receipt->updated_at])
                    @include('includes.forms.datetime',             ['time' => date("Y-m-d",strtotime($receipt->receipt_date))])
                    @include('includes.forms.users',                ['users' => DB::table('users')->where('user_company_id','=',$company->company_id)->where('is_disabled','!=',1)->orderBy('last_name')->get(), 'selected_user_id' => $receipt->receipt_user_id])
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="source">Lähde:</label>
                        <div class="col-sm-10">
                            <select class="form-control element-width-auto form-field-width" id="source" name="source">
                                <option value="internal" {{($receipt->receipt_from_microlocation_id ? 'selected="selected"' : '')}}>Sisäinen</option>
                                <option value="external" {{($receipt->from_community_id ? 'selected="selected"' : '')}}>Ulkoinen</option>
                                <option value="supplier" {{($receipt->from_supplier ? 'selected="selected"' : '')}}>Yksityinen</option>
                            </select>
                        </div>
                    </div>
                    @include('includes.forms.microlocation',        ['microlocations' => DB::table('microlocations')->where('microlocation_company_id','=',$company->company_id)->where('is_disabled','!=',1)->get(), 'tag' => 'from_microlocation', 'name' => 'Toimipisteestä:'])
                    <div class="form-group row" id="from_community"></div>
                    @include('includes.forms.microlocation',        ['microlocations' => DB::table('microlocations')->where('microlocation_company_id','=',$company->company_id)->where('is_disabled','!=',1)->get(), 'selected_microlocation_id' => $receipt->receipt_to_microlocation_id, 'tag' => 'to_microlocation', 'name' => 'Toimipisteeseen:', 'disabled' => Auth::user()->user_type_id > 2])
                    @include('includes.forms.materials',            ['materials' => DB::table('material_names')->whereIn('material_type',['textile','raw waste','refined'])->get(), 'selected_material_id' => $receipt->receipt_material_id])
                    @include('includes.forms.weight',               ['weight' => $receipt->receipt_weight])
                    @include('includes.forms.distance',             ['distance' => $receipt->distance_km])
                    @include('includes.forms.ewc_code',             ['code' => $receipt->receipt_ewc_code])
                    @include('includes.forms.for_issue',            ['checked' => $receipt->is_for_issue])
                    @include('includes.forms.buttons',              ['submit' => 'Tallenna', 'cancel' => url('/companies/'.$company->company_id.'/receipts')])
                </form>
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
        function source(){
            $source = $("#source").val();
            $ml_id = {{$receipt->receipt_from_microlocation_id ?: 0}}
            $community_id = {{$receipt->from_community_id ?: 0}}
            $supplier = "{{$receipt->from_supplier ?: ''}}";
            $.ajax({
                type: "get",
                url: '{{URL::to(trim(url()->current(),'/').'/source')}}',
                data: {'source':$source,'ml_id':$ml_id,'community_id':$community_id,'supplier':$supplier},
                success:function(data){
                    $("#from").empty().html(data);
                }
            });
            if($source != 'external'){
                $("#from_community").hide()
            }
            else{
                $("#from_community").show()
            }
        };
        function communities(){
            $from_company = $("#from_company").val();
            $community_id = {{$receipt->from_community_id ?: 0}}
            if($community_id!=0){
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
@endsection
