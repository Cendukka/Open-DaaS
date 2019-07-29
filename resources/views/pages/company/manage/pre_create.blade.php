@extends('layouts.macrolocation')
@section('content')
    <div id="content2" class="row">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3>Luo esilajittelukirjaus </h3>
            </div>
            <div class="panel-body">
                @includeWhen($errors->any(),'includes.forms.errors', ['errors' => $errors])
                <form method="post" action="pre-store" class="form-text-align-padd">
                    @csrf
                    @include('includes.forms.datetime',     ['time' => date('Y-m-d H:i:s')])
                    @include('includes.forms.users',        ['users' => DB::table('users')->where('user_company_id','=',$company->company_id)->orderBy('last_name')->get()])
                    @include('includes.forms.materials',    ['materials' => DB::table('material_names')->whereIn('material_type',['presorted','refined'])->get()])
                    @include('includes.forms.microlocation',['microlocations' => DB::table('microlocations')->where('microlocation_company_id','=',$company->company_id)->get(), 'tag' => 'microlocation', 'name' => 'Microlokaatio:'])
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="receipt">Saapunut kirjaus:</label>
                        <div class="col-sm-10">
                            <select class="form-control element-width-auto form-field-width" name="receipt" id="receipt">
                            </select>
                        </div>
                    </div>
                    @include('includes.forms.weight', ['weight' => ''])
                    @include('includes.forms.for_issue', ['checked' => 0])
                    @include('includes.forms.buttons', ['submit' => 'Lisää', 'cancel' => url('/companies/'.$company->company_id.'/pre')])
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
            var $receipt_id = '';
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
