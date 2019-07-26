@extends('layouts.macrolocation')
@section('content')
    <div id="content2" class="row">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3>Lisää lähetys</h3>
            </div>
            <div class="panel-body">
                @includeWhen($errors->any(),'includes.forms.errors', ['errors' => $errors])
                <form method="post" action="issues-store" class="form-text-align-padd">
                    @csrf
                    @include('includes.forms.datetime', ['time' => date('Y-m-d H:i:s')])
                    @include('includes.forms.users', ['users' => DB::table('users')->where('user_company_id','=',$company->company_id)->orderBy('last_name')->get()])
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="type">Lähetyksen tyyppi:</label>
                        <div class="col-sm-10">
                            <select class="form-control element-width-auto form-field-width" id="type" name="type">
                                <option selected="selected" disabled hidden value=""></option>
                                @foreach (DB::table('issue_types')->orderBy('issue_typename')->get() as $issue_type)
                                    <option value="{{$issue_type->issue_type_id}}">{{title_case($issue_type->issue_typename)}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    @include('includes.forms.microlocation',['microlocations' => DB::table('microlocations')->where('microlocation_company_id','=',$company->company_id)->get(),'tag' => 'from_microlocation', 'name' => 'Mikrolokaatiosta:'])
                    <div id="to_microlocation" class="form-group">
                        <label for="to_microlocation">Mihin microlokaatioon:</label>
                        <select class="form-control element-width-auto" name="to_microlocation">
                            @foreach (DB::table('microlocations')->where('microlocation_company_id','=',$company->company_id)->get() as $ml)
                                <option value="{{$ml->microlocation_id}}">{{title_case($ml->microlocation_name)}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div id="details" class="form-group">
                        @include('includes.forms.details')
                    </div>
                    <br>
                    <button id="addMat" type="button" class="btn" style="margin-bottom:10px;">Lisää materiaali</button>
                    <button id="removeMat" type="button" class="btn" style="margin-bottom:10px;">Poista materiaali</button>
                    <br>
                    <button type="submit" class="btn btn-primary" style="margin-bottom:10px;">Tallenna</button>
                    <button id="cancel" type="button" class="btn" style="margin-bottom:10px;" onclick="location.href='{{url('/companies/'.$company->company_id.'/issues')}}';">Peruuta</button>
                </form>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>
    <script type="text/javascript">
        function addMat(){
            $.ajax({
                type: 'GET',
                url : "/companies/{{$company->company_id}}/manage/issues/new_details",
                success : function (data) {
                    $("#details").append(data);
                }
            });
        }
        $('#removeMat').on('click',(function(){
            if($("#details").children("div").length > 1){
                $("#details").children("div:last").remove();
                $("#details").children("br:last").remove();
                $("#details").children("p:last").remove();
            }
        }));
        function toMicrolocation(){
            var $issueType = $("#type").val();
            if($issueType == 1){ // Transport
                $("#to_microlocation").show();
            }
            else{
                $("#to_microlocation").hide();
            }
        }
        function clearMaterials(){
            var $ml_id = $("#from_microlocation").val();
            $.ajax({
                type: "get",
                url: '{{URL::to('/companies/'.$company->company_id.'/manage/issues/inventory')}}',
                data: {'ml_id':$ml_id},
                success:function(data){
                    selects = $(".material-select").children('option');
                    selects.each(function(k,v){
                        if($.inArray($(this).val(),Object.keys(data)) >= 0){
                            $(this).prop("disabled", false).prop("hidden", false);
                            $(this).text($(this).text().substring(0,$(this).text().indexOf("["))+' ['+data[$(this).val()]+']');
                        }
                        else{
                            $(this).prop("disabled", true).prop("hidden", true);
                        }
                    });
                }
            })
        }
        $('#addMat').on('click',function(){
            addMat();
            clearMaterials();
        });

        // Show/hide To Microlocation depending on issue type
        $(document).ready(toMicrolocation);
        $('#type').on('change',toMicrolocation);

        // Clear all materials if From Microlocation is changed
        $('#from_microlocation').on('change',function(){
            if($("#details").children("div").length == 0){
                addMat();
                clearMaterials();
            }
        });

        // Add first material, if none exists
        $(document).ready(function(){
            if($("#details").children("div").length == 0){
                addMat();
                clearMaterials();
            }
        });

        $('#from_microlocation').on('change',clearMaterials);
    </script>
    <script type="text/javascript">
        $('.timepicker').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss'
        });
    </script>
@endsection
