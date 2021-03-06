
{{--Form for creating refine sorting record--}}

@extends('layouts.macrolocation')
@section('title', 'Hallinnoi: Hienolajittelun luominen')
@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3>Luo hienolajittelukirjaus </h3>
        </div>
        <div class="panel-body">
            @includeWhen($errors->any(),'includes.forms.errors', ['errors' => $errors])
            <form method="post" action="refined-store" class="form-text-align-padd" onsubmit="return confirm('Hienolajittelu-kirjaus luodaan. Haluatko jatkaa?');">
                @csrf
                @include('includes.forms.datetime',         ['time' => date('d-m-Y')])
                @include('includes.forms.users',            ['users' => DB::table('users')->where('user_company_id','=',$company->company_id)->orderBy('last_name')->where('is_disabled','!=',1)->get()])
                @include('includes.forms.microlocation',    ['microlocations' => DB::table('microlocations')->where('microlocation_company_id','=',$company->company_id)->where('is_disabled','!=',1)->get(), 'selected_microlocation_id' => Auth::user()->user_microlocation_id, 'tag' => 'microlocation', 'name' => 'Toimipiste:', 'disabled' => Auth::user()->user_type_id > 2])
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label" for="origin">Tekstiilin alkuperä:</label>
                    <div class="col-sm-10">
                        <select class="form-control element-width-auto form-field-width" name="origin" id="origin">
                            <option selected="selected" disabled hidden value=""></option>
                            <option value="presort">Esilajittelu</option>
                            <option value="receipt">Saapuneet kirjaus</option>
                        </select>
                    </div>
                </div>
                <div id="originSelect" class="form-group row">
                </div>
                @include('includes.forms.materials',        ['materials' => DB::table('material_names')->where('material_type','=','textile')->get()])
                @include('includes.forms.weight')
                @include('includes.forms.description')
                @include('includes.forms.buttons',          ['submit' => 'Lisää', 'cancel' => url('/companies/'.$company->company_id.'/refined')])
            </form>
        </div>
    </div>
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
