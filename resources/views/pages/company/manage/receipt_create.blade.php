@extends('layouts.macrolocation')
@section('title', 'Hallinnoi: Saapuneiden luominen')
@section('content')

        <div class="panel panel-default">
            <div class="panel-heading">
                <h3>Materiaalin vastaanotto</h3>
            </div>
            <div class="panel-body">
                @includeWhen($errors->any(),'includes.forms.errors', ['errors' => $errors])
                <form method="post" action="receipts-store" class="form-text-align-padd" onsubmit="return confirm('Saapunut-kirjaus luodaan. Haluatko jatkaa?');">
                    @csrf
                    @include('includes.forms.datetime',             ['time' => date('Y-m-d')])
                    @include('includes.forms.users',                ['users' => DB::table('users')->where('user_company_id','=',$company->company_id)->where('is_disabled','!=',1)->orderBy('last_name')->get()])
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
                    @include('includes.forms.microlocation',        ['microlocations' => DB::table('microlocations')->where('microlocation_company_id','=',$company->company_id)->where('is_disabled','!=',1)->get(), 'tag' => 'from_microlocation', 'name' => 'Toimipisteestä:'])
                    <div class="form-group row" id="from_community"></div>
                    @include('includes.forms.microlocation',        ['microlocations' => DB::table('microlocations')->where('microlocation_company_id','=',$company->company_id)->where('is_disabled','!=',1)->get(), 'selected_microlocation_id' => Auth::user()->user_microlocation_id, 'tag' => 'to_microlocation', 'name' => 'Toimipisteeseen:', 'disabled' => Auth::user()->user_type_id > 2])
                    @include('includes.forms.materials',            ['materials' => DB::table('material_names')->whereIn('material_type',['textile','raw waste','refined'])->get()])
                    @include('includes.forms.weight')
                    @include('includes.forms.distance')
                    @include('includes.forms.ewc_code',             ['code' => '200111'])
                    @include('includes.forms.for_issue')
                    @include('includes.forms.buttons',              ['submit' => 'Lisää', 'cancel' => url('/companies/'.$company->company_id.'/receipts')])
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
        $(document).on("change", '#source', function(e) {
            $source = $("#source").val();
            $.ajax({
                type: "get",
                url: '{{URL::to(trim(url()->current(),'/').'/source')}}',
                data: {'source':$source},
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
