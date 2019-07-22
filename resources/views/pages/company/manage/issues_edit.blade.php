@extends('layouts.macrolocation')
@section('content')
    <div id="content2" class="row">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3>Muokkaa lähetystä </h3>
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
                <form method="post" action="issues-update" class="form-text-align-padd">
                    @csrf
                    <div class="form-group">
                        <label>Lähetys luotu:&nbsp</label>{{$issue->created_at}}
                        <p></p>
                        <label>Lähetys muokattu:&nbsp</label>{{$issue->updated_at}}
                    </div>
                    <div class="form-group">
                        <label for="datetime">Päivämäärä:</label>
                        <div style="position: relative">
                            <input type="text" class="form-control timepicker element-width-auto" name="datetime" value="{{$issue->issue_date}}">
                        </div>
                    </div>
                    <div id="from" class="form-group">
                        <label for="from_microlocation">Mistä microlokaatiosta:</label>
                        <select class="form-control element-width-auto" name="from_microlocation">
                            @foreach (DB::table('microlocations')->where('microlocation_company_id','=',$company->company_id)->get() as $ml)
                                <option value="{{$ml->microlocation_id}}" {{($ml->microlocation_id == $issue->issue_from_microlocation_id ? 'selected="selected"' : '')}}>{{title_case($ml->microlocation_name)}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="user">Käyttäjä:</label>
                        <select class="form-control element-width-auto" name="user">
                            @foreach (DB::table('users')->where('user_company_id','=',$company->company_id)->orderBy('last_name')->get() as $user)
                                <option value="{{$user->user_id}}" {{($user->user_id == $issue->issue_user_id ? 'selected="selected"' : '')}}>{{title_case($user->last_name.' '.$user->first_name)}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div id="from" class="form-group">
                        <label for="from_microlocation">From microlocation:&nbsp</label>
                        <select id="from_microlocation" name="from_microlocation">
                            @foreach (DB::table('microlocations')->where('microlocation_company_id','=',$company->company_id)->get() as $ml)
                                <option value="{{$ml->microlocation_id}}" {{($ml->microlocation_id == $issue->issue_from_microlocation_id ? 'selected="selected"' : '')}}>{{title_case($ml->microlocation_name)}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div id="to_microlocation" class="form-group">
                        <label for="to_microlocation">Mihin microlokaatioon:</label>
                        <select class="form-control element-width-auto" name="to_microlocation">
                            @foreach (DB::table('microlocations')->where('microlocation_company_id','=',$company->company_id)->get() as $ml)
                                <option value="{{$ml->microlocation_id}}" {{($ml->microlocation_id == $issue->issue_to_microlocation_id ? 'selected="selected"' : '')}}>{{title_case($ml->microlocation_name)}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div id="details" class="form-group">
                        @foreach (DB::table('inventory_issue_details')->where('detail_issue_id','=',$issue->issue_id)->get() as $detail)
                        <br>
                        <div class="form-group detail-info">
                            <div class="form-group">
                                <label for="material">Material:&nbsp</label>
                                <select name="material[]" id="material[]" class="material-select">>
                                    @foreach (DB::table('material_names')->whereIn('material_type',['textile','raw waste','refined'])->get() as $mat)
                                        <option value="{{$mat->material_id}}" {{($mat->material_id == $detail->detail_material_id ? 'selected="selected"' : '')}}>{{title_case($mat->material_name)}} []</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="ewc_code">EWC-koodi:</label>
                                <select class="form-control element-width-auto" name="ewc_code[]">
                                    @foreach (DB::table('ewc_codes')->get() as $ewc)
                                        <option value="{{$ewc->ewc_code}}" {{($ewc->ewc_code== $detail->detail_ewc_code ? 'selected="selected"' : '')}}>{{title_case($ewc->ewc_code)}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="weight">Paino (Kg):</label>
                                <input type="text" class="form-control element-width-auto" name="weight[]" value="{{$detail->detail_weight}}"/>
                            </div>
                        </div>
                            <p>*******************************</p>
                        @endforeach
                    </div>
                    <br>
                    <button id="addMat" type="button" class="btn">Lisää materiaali</button>
                    <button id="removeMat" type="button" class="btn">Poista materiaali</button>
                    <br>
                    <button type="submit" class="btn btn-primary">Tallenna</button>
                    <button id="cancel" type="button" class="btn" onclick="location.href='{{url()->previous()}}';">Peruuta</button>
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
            $("#details").append(
                '<br>' +
                '<div class="form-group detail-info">' +
                '<div class="form-group">' +
                '<label for="material">Material:&nbsp</label>' +
                '<select name="material[]" id="material[]" class="material-select">' +
                '<option selected="selected" disabled hidden value=""></option>' +
                    @foreach (DB::table('material_names')->whereIn('material_type',['textile','raw waste','refined'])->get() as $mat)
                        '<option value="{{$mat->material_id}}">{{title_case($mat->material_name)}} []</option>' +
                    @endforeach
                        '</select>' +
                '</div>' +
                '<div class="form-group">' +
                '<label for="ewc_code">EWC Code:&nbsp</label>' +
                '<select name="ewc_code[]">' +
                    @foreach (DB::table('ewc_codes')->get() as $ewc)
                        '<option value="{{$ewc->ewc_code}}" >{{title_case($ewc->ewc_code)}}</option>' +
                    @endforeach
                        '</select>' +
                '</div>' +
                '<div class="form-group"> <label for="weight">Weight (kg):&nbsp</label>' +
                '<input type="text" class="form-control form-control-sm" name="weight[]" value="0"/>' +
                '</div>' +
                '*******************************' +
            '</div>'
            );
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
            }
        });
        $(document).ready(clearMaterials);
        $('#from_microlocation').on('change',clearMaterials);
    </script>
    <script type="text/javascript">
        $('.timepicker').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss'
        });
    </script>
@endsection
