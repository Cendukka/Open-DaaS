<div class="form-group row">
    <label class="col-sm-2 col-form-label" for="{{$tag}}">{{$name}}</label>
    <div class="col-sm-10">
        <select class="form-control element-width-auto form-field-width" name="{{$tag}}" id="{{$tag}}">
            <option value="" selected="selected" hidden disabled value=""></option>
            @foreach ($microlocations as $ml)
                <option value="{{$ml->microlocation_id}}" {{($ml->microlocation_id == $selected_microlocation_id ? 'selected="selected"' : '')}}>{{title_case($ml->microlocation_name)}}</option>
            @endforeach
        </select>
    </div>
</div>