
{{--Form for editing presortting records--}}

@extends('layouts.macrolocation')
@section('title', 'Hallinnoi: Esilajiteltun muokkaus')
@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3>Muokkaa esilajittelukirjauksia </h3>
        </div>
        <div class="panel-body">
            @includeWhen($errors->any(),'includes.forms.errors', ['errors' => $errors])
            <form method="post" action="pre-update" class="form-text-align-padd" onsubmit="return confirm('Esilajittelu-kirjausta muokataan. Haluatko jatkaa?');">
                @csrf
                @include('includes.forms.created_modified',     ['created_at' => $pre->created_at, 'updated_at' => $pre->updated_at])
                @include('includes.forms.datetime',             ['time' => date("d-m-Y",strtotime($pre->pre_sorting_date))])
                @include('includes.forms.users',                ['users' => DB::table('users')->where('user_company_id','=',$company->company_id)->where('is_disabled','!=',1)->orderBy('last_name')->get(), 'selected_user_id' => $pre->pre_sorting_user_id])
                @include('includes.forms.materials',            ['materials' => DB::table('material_names')->whereIn('material_type',['presorted','refined'])->get(), 'selected_material_id' => $pre->pre_sorting_material_id])
                @php
                    // Find the microlocation from receipt_id
                    $selected_microlocation_id = DB::table('microlocations')
                        ->join('inventory_receipt','receipt_to_microlocation_id','microlocation_id')
                        ->join('material_names','receipt_material_id','material_id')
                        ->where('microlocation_company_id','=',$company->company_id)
                        ->where('material_type','=','Raw Waste')
                        ->where('receipt_id',$pre->pre_sorting_receipt_id)
                        ->select('microlocation_id')
                        ->first()
                        ->microlocation_id;
                @endphp
                @include('includes.forms.microlocation',        ['microlocations' => DB::table('microlocations')->where('microlocation_company_id','=',$company->company_id)->where('is_disabled','!=',1)->get(), 'selected_microlocation_id' => $selected_microlocation_id, 'tag' => 'microlocation', 'name' => 'Toimipiste:', 'disabled' => Auth::user()->user_type_id > 2])
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label" for="receipt">Saapunut kirjaus:</label>
                    <div class="col-sm-10">
                        <select class="form-control element-width-auto form-field-width" name="receipt" id="receipt">
                        </select>
                    </div>
                </div>
                @include('includes.forms.weight',               ['weight' => $pre->pre_sorting_weight])
                @include('includes.forms.for_issue',            ['checked' => $pre->is_for_issue])
                @include('includes.forms.buttons',              ['submit' => 'Tallenna', 'cancel' => url('/companies/'.$company->company_id.'/pre')])
            </form>
        </div>
    </div>
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
