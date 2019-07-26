@extends('layouts.macrolocation')
@section('content')
    <div id="content2" class="row">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3>Materiaalin vastaanotto</h3>
            </div>
            <div class="panel-body">
                @includeWhen($errors->any(),'includes.forms.errors', ['errors' => $errors])
                <form method="post" action="receipts-store" class="form-text-align-padd">
                    @csrf
                    @include('includes.forms.datetime', ['time' => date('Y-m-d')])
                    @include('includes.forms.users', ['users' => DB::table('users')->where('user_company_id','=',$company->company_id)->orderBy('last_name')->get()])
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="source">Lähde:</label>
                        <div class="col-sm-10">
                            <select class="form-control element-width-auto form-field-width" id="source" name="source">
                                <option value="internal">Sisäinen</option>
                                <option value="external">Ulkoinen</option>
                                <option value="supplier">Toimittaja</option>
                            </select>
                        </div>
                    </div>
                    @include('includes.forms.microlocation',['microlocations' => DB::table('microlocations')->where('microlocation_company_id','=',$company->company_id)->get(), 'tag' => 'from_microlocation', 'name' => 'Mikrolokaatiosta:'])
                    @include('includes.forms.microlocation',['microlocations' => DB::table('microlocations')->where('microlocation_company_id','=',$company->company_id)->get(), 'tag' => 'to_microlocation', 'name' => 'Microlokaatioon:'])
                    @include('includes.forms.materials', ['materials' => DB::table('material_names')->whereIn('material_type',['textile','raw waste','refined'])->get()])
                    @include('includes.forms.weight')
                    @include('includes.forms.distance')
                    @include('includes.forms.ewc_code')
                    @include('includes.forms.for_issue')
                    <br>
                    <button type="submit" class="btn btn-primary">Lisää</button>
                    <button id="cancel" type="button" class="btn" onclick="location.href='{{url()->previous()}}';">Peruuta</button>
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
