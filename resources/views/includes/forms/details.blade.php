{{-- Issue Details for creating and editing --}}
<br>
<div class="col-md panel panel-default panel-body element-width-auto form-field-width p-4" style="max-width:500px;">
    <div class="form-group detail-info">
        <div class="form-group row">
            <label class="col-sm-2 col-form-label" for="material">Tekstiili:</label>
            <div class="col-sm-10">
                <select class="form-control material-select" name="material[]" id="material[]">
                    <option selected="selected" disabled hidden value=""></option>
                    @foreach (DB::table('material_names')->whereIn('material_type',['textile','raw waste','refined'])->get() as $mat)
                        <option value="{{$mat->material_id}}" {{isset($detail) ? ($mat->material_id == $detail->detail_material_id ? 'selected="selected"' : '') : ''}}>{{title_case($mat->material_name)}} []</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label" for="ewc_code">EWC-koodi:</label>
            <div class="col-sm-10">
                <select class="form-control" name="ewc_code[]">
                    <option selected="selected" disabled hidden value=""></option>
                    @foreach (DB::table('ewc_codes')->get() as $ewc)
                        <option value="{{$ewc->ewc_code}}" {{isset($detail) ? ($ewc->ewc_code== $detail->detail_ewc_code ? 'selected="selected"' : '') : ($ewc->ewc_code == '200111' ? 'selected="selected"' : '')}}>{{title_case($ewc->ewc_code.' - '.$ewc->description)}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label" for="weight">Paino (Kg):</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="weight[]" value="{{isset($detail) ? $detail->detail_weight : ''}}"/>
            </div>
        </div>
    </div>
</div>
