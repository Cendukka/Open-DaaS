<div class="form-group row">
    <label class="col-sm-2 col-form-label" for="material">Materiaali:</label>
    <div class="col-sm-10">
        <select class="form-control element-width-auto form-field-width" name="material">
            <option selected="selected" disabled hidden value=""></option>
            @foreach ($materials as $material)
                <option value="{{$material->material_id}}" {{isset($selected_material_id) ? ($material->material_id == $selected_material_id ? 'selected="selected"' : '') : ''}}>{{title_case($material->material_name)}}</option>
            @endforeach
        </select>
    </div>
</div>