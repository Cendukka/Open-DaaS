{{-- A field where you need a larger text area --}}
<div class="form-group row">
    <label class="col-sm-2 col-form-label" for="description">Lisätietoja:</label>
    <div class="col-sm-10">
        <textarea type="text" class="form-control element-width-auto form-field-width" rows="4" maxlength="191" name="description">{{isset($description) ? $description : ''}}</textarea>
    </div>
</div>