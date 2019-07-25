@extends('layouts.macrolocation')
@section('content')
    <div id="content2" class="row">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3>Muokkaa saapuneet-kirjausta </h3>
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
                <form method="post" action="receipts-update" class="form-text-align-padd">
                    @csrf
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Kirjattu:</label>
                        <div class="col-sm-10">
                            {{$receipt->created_at}}
                        </div>
                    </div>
                    @if($receipt->created_at != $receipt->updated_at)
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Muokattu:</label>
                        <div class="col-sm-10">
                            {{$receipt->updated_at}}
                        </div>
                    </div>
                    @endif
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="datetime">Päivämäärä:</label>
                        <div class="col-sm-10" style="position: relative">
                            <input type="text" class="form-control timepicker element-width-auto form-field-width" name="datetime" value="{{date("Y-m-d",strtotime($receipt->receipt_date))}}"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="user">Käyttäjä:</label>
                        <div class="col-sm-10">
                            <select class="form-control element-width-auto form-field-width" name="user">
                                @foreach (DB::table('users')->where('user_company_id','=',$company->company_id)->orderBy('last_name')->get() as $user)
                                    <option value="{{$user->user_id}}" {{($user->user_id == $receipt->receipt_user_id ? 'selected="selected"' : '')}}>{{title_case($user->last_name.' '.$user->first_name)}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="material">Materiaali:</label>
                        <div class="col-sm-10">
                            <select class="form-control element-width-auto form-field-width" name="material">
                                <option selected="selected" disabled hidden value=""></option>
                                @foreach (DB::table('material_names')->whereIn('material_type',['textile','raw waste','refined'])->get() as $material)
                                    <option value="{{$material->material_id}}" {{($material->material_id == $receipt->receipt_material_id ? 'selected="selected"' : '')}}>{{title_case($material->material_name)}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="source">Lähde:</label>
                        <div class="col-sm-10">
                            <select  class="form-control element-width-auto form-field-width" id="source" name="source">
                                <option value="internal" {{($receipt->receipt_from_microlocation_id ? 'selected="selected"' : '')}}>Sisäinen</option>
                                <option value="external" {{($receipt->from_community_id ? 'selected="selected"' : '')}}>Ulkoinen</option>
                                <option value="supplier" {{($receipt->from_supplier ? 'selected="selected"' : '')}}>Yksityinen</option>
                            </select>
                        </div>
                    </div>
                    <div id="from" class="form-group row">
                        <label class="col-sm-2 col-form-label" for="from_microlocation">Mikrolokaatiosta:</label>
                        <div class="col-sm-10">
                            <select class="form-control element-width-auto form-field-width" name="from_microlocation">
                                <option value="" selected="selected" hidden disabled value=""></option>
                                @foreach (DB::table('microlocations')->where('microlocation_company_id','=',$company->company_id)->get() as $ml)
                                    <option value="{{$ml->microlocation_id}}">{{title_case($ml->microlocation_name)}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="to_microlocation">Microlokaatioon:</label>
                        <div class="col-sm-10">
                            <select class="form-control element-width-auto form-field-width" name="to_microlocation">
                                <option value="" selected="selected" hidden disabled value=""></option>
                                @foreach (DB::table('microlocations')->where('microlocation_company_id','=',$company->company_id)->get() as $ml)
                                    <option value="{{$ml->microlocation_id}}" {{($ml->microlocation_id == $receipt->receipt_to_microlocation_id ? 'selected="selected"' : '')}}>{{title_case($ml->microlocation_name)}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="weight">Paino (Kg):</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control element-width-auto form-field-width" name="weight" value="{{$receipt->receipt_weight}}"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="distance">Matka (Km):</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control element-width-auto form-field-width" name="distance" value="{{$receipt->distance_km}}"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="ewc">EWC-Koodi:</label>
                        <div class="col-sm-10">
                            <select class="form-control element-width-auto form-field-width" name="ewc">
                                @foreach (DB::table('ewc_codes')->get() as $ewc)
                                    <option value="{{$ewc->ewc_code}}" {{($ewc->ewc_code== $receipt->receipt_ewc_code ? 'selected="selected"' : '')}}>{{title_case($ewc->ewc_code)}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-2"></div>
                        <div class="col-sm-10">
                            <div class="form-check">
                                <input class="form-check-input" {{$receipt->is_for_issue==True ? 'checked' : ''}} type="checkbox" id="for_issue" name="for_issue">
                                <label class="form-check-label" for="for_issue">Materiaali menee lähetykseen</label>
                            </div>
                            <small class="form-text text-muted">
                                Valitse, jos materiaali menee suoraan lähetykseen, eikä sitä lajitella.<br>
                                Jos valittuna, tämä lähetys ei näy kirjatessa lajitteluita.
                            </small>
                        </div>
                    </div>
                    <br>
                    <button type="submit" class="btn btn-primary">Save</button>
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
            })
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
