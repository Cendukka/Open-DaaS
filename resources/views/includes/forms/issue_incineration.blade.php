<br>
<div class="col-md panel panel-default panel-body element-width-auto form-field-width" style="max-width:500px;">
    <div class="form-group detail-info">
        <div class="form-group row">
            <label class="col-sm-2 col-form-label" for="weight">Paino (Kg):</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="weight[]" value="{{isset($detail) ? $detail->detail_weight : ''}}"/>
            </div>
        </div>
    </div>
</div>