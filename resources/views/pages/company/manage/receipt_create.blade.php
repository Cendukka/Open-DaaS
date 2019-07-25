@extends('layouts.macrolocation')
@section('content')
    <div id="content2" class="row">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3>Materiaalin vastaanotto</h3>
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
                <form method="post" action="receipts-store" class="form-text-align-padd">
                    @csrf
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="datetime">Päivämäärä:</label>
                        <div class="col-sm-10" style="position: relative">
                            <input type="text" class="form-control timepicker element-width-auto form-field-width" name="datetime" value="{{date('Y-m-d')}}"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="user">Käyttäjä:</label>
                        <div class="col-sm-10">
                            <select class="form-control element-width-auto form-field-width" name="user">
                                @foreach (DB::table('users')->where('user_company_id','=',$company->company_id)->orderBy('last_name')->get() as $user)
                                    <option value="{{$user->user_id}}">{{title_case($user->last_name.' '.$user->first_name)}}</option>
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
                                    <option value="{{$material->material_id}}">{{title_case($material->material_name)}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
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
                                    <option value="{{$ml->microlocation_id}}">{{title_case($ml->microlocation_name)}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="weight">Paino (Kg):</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control element-width-auto form-field-width" name="weight"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="distance">Matka (Km):</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control element-width-auto form-field-width" name="distance"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="ewc">EWC-Koodi:</label>
                        <div class="col-sm-10">
                            <select class="form-control element-width-auto form-field-width" name="ewc">
                                <option value="" selected="selected" hidden disabled value=""></option>
                                @foreach (DB::table('ewc_codes')->get() as $ewc)
                                    <option value="{{$ewc->ewc_code}}">{{title_case($ewc->ewc_code)}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-2"></div>
                        <div class="col-sm-10">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="for_issue" name="for_issue">
                                <label class="form-check-label" for="for_issue">Materiaali menee lähetykseen</label>
                            </div>
                            <small class="form-text text-muted">
                                Valitse, jos materiaali menee suoraan lähetykseen, eikä sitä lajitella.<br>
                                Jos valittuna, tämä lähetys ei näy kirjatessa lajitteluita.
                            </small>
                        </div>
                    </div>
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
