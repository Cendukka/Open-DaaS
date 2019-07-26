@extends('layouts.macrolocation')
@section('content')
    <div id="content2" class="row">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3>Luo hienolajittelu kirjaus </h3>
            </div>
            <div class="panel-body">
                @includeWhen($errors->any(),'includes.forms.errors', ['errors' => $errors])
                <form method="post" action="refined-store" class="form-text-align-padd">
                    @csrf
                    @include('includes.forms.datetime',     ['time' => date('Y-m-d H:i:s')])
                    @include('includes.forms.users',        ['users' => DB::table('users')->where('user_company_id','=',$company->company_id)->orderBy('last_name')->get()])
                    @include('includes.forms.microlocation',['microlocations' => DB::table('microlocations')->where('microlocation_company_id','=',$company->company_id)->get(), 'tag' => 'microlocation', 'name' => 'Microlokaatio:'])
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
                    @include('includes.forms.materials',    ['materials' => DB::table('material_names')->where('material_type','=','textile')->get()])
                    @include('includes.forms.weight')
                    @include('includes.forms.description')
                    <button type="submit" class="btn btn-primary">Lisää</button>
                    <button id="cancel" type="button" class="btn" onclick="location.href='{{url('/companies/'.$company->company_id.'/refined')}}';">Peruuta</button>
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
