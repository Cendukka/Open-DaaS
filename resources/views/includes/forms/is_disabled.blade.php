<div class="form-group row">
    <div class="col-sm-2"></div>
    <div class="col-sm-10">
        <div class="custom-control custom-checkbox my-1 mr-sm-2">
            <input type="checkbox" class="custom-control-input" id="is_disabled" name="is_disabled" {{isset($is_disabled) ? ($is_disabled > 0 ? 'checked' : '') : ''}}>
            <label class="custom-control-label" for="is_disabled">Poistettu käytöstä</label>
        </div>
    </div>
</div>