@extends('layouts.macrolocation')
@section('content')
    <div id="content2" class="row">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3>Add issue </h3>
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
                <form method="post" action="issues-store">
                    @csrf
                    <div class="form-group">
                        <label for="user">User:&nbsp</label>
                        <select name="user">
                            @foreach (DB::table('users')->where('user_company_id','=',$company->company_id)->orderBy('last_name')->get() as $user)
                                <option value="{{$user->user_id}}">{{title_case($user->last_name.' '.$user->first_name)}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="datetime">Date & Time:&nbsp</label>
                        <div style="position: relative">
                            <input type="text" class="form-control timepicker form-control" name="datetime" value="{{date('Y-m-d H:i:s')}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="type">Issue Type:&nbsp</label>
                        <select id="type" name="type">
                            @foreach (DB::table('issue_types')->orderBy('issue_typename')->get() as $issue)
                                <option value="{{$issue->issue_type_id}}">{{title_case($issue->issue_typename)}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div id="from" class="form-group">
                        <label for="from_microlocation">From microlocation:&nbsp</label>
                        <select name="from_microlocation">
                            <option value="" selected="selected" hidden disabled></option>
                            @foreach (DB::table('microlocations')->where('microlocation_company_id','=',$company->company_id)->get() as $ml)
                                <option value="{{$ml->microlocation_id}}">{{title_case($ml->microlocation_name)}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div id="to_microlocation" class="form-group">
                        <label for="to_microlocation">To microlocation:&nbsp</label>
                        <select name="to_microlocation">
                            <option selected="selected" disabled hidden value=""></option>
                            @foreach (DB::table('microlocations')->where('microlocation_company_id','=',$company->company_id)->get() as $ml)
                                <option value="{{$ml->microlocation_id}}">{{title_case($ml->microlocation_name)}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div id="details" class="form-group">
                        <br>
                        <div class="form-group detail-info">
                            <div class="form-group">
                                <label for="material">Material:&nbsp</label>
                                <select name="material[]">
                                    <option selected="selected" disabled hidden value=""></option>
                                    @foreach (DB::table('material_names')->whereIn('material_type',['textile','raw waste','refined'])->get() as $mat)
                                        <option value="{{$mat->material_id}}" >{{title_case($mat->material_name)}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="ewc_code">EWC Code:&nbsp</label>
                                <select name="ewc_code[]">
                                    @foreach (DB::table('ewc_codes')->get() as $ewc)
                                        <option value="{{$ewc->ewc_code}}" >{{title_case($ewc->ewc_code)}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group"> <label for="weight">Weight (kg):&nbsp</label>
                                <input type="text" class="form-control form-control-sm" name="weight[]" value="0"/>
                            </div>
                        </div>
                    </div>
                    <br>
                    <button id="addMat" type="button" class="btn">Add Material</button>
                    <br>
                    <br>
                    <button id="removeMat" type="button" class="btn">Remove Material</button>
                    <br>
                    <br>
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>
    <script type="text/javascript">
        $('#addMat').on('click',(function(){
            $("#details").append(
                '<br><div class="form-group detail-info"><div class="form-group"><label for="material">Material:&nbsp</label><select name="material[]"><option selected="selected" disabled hidden value=""></option>@foreach (DB::table('material_names')->whereIn('material_type',['textile','raw waste','refined'])->get() as $mat)<option value="{{$mat->material_id}}" >{{title_case($mat->material_name)}}</option>@endforeach</select> </div> <div class="form-group"> <label for="ewc_code">EWC Code:&nbsp</label> <select name="ewc_code[]">@foreach (DB::table('ewc_codes')->get() as $ewc)<option value="{{$ewc->ewc_code}}" >{{title_case($ewc->ewc_code)}}</option>@endforeach</select> </div> <div class="form-group"> <label for="weight">Weight (kg):&nbsp</label> <input type="text" class="form-control form-control-sm" name="weight[]" value="0"/> </div> </div>'
            );
        }));
        $('#removeMat').on('click',(function(){
            if($("#details").children("div").length > 1){
                $("#details").children("div:last").remove();
                $("#details").children("br:last").remove();
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
        };
        $(document).ready(toMicrolocation);
        $('#type').on('change',toMicrolocation);
    </script>
    <script type="text/javascript">
        $('.timepicker').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss'
        });
    </script>
@endsection
