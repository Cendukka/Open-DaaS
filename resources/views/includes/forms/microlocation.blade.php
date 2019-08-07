<div class="form-group row" id="from">
    <label class="col-sm-2 col-form-label" for="{{$tag}}">{{$name}}</label>
    <div class="col-sm-10" {{$disabled ? 'disabled hidden' : ''}}>
        <select class="form-control element-width-auto form-field-width" name="{{$tag}}" id="{{$tag}}">
            <option selected="selected" hidden disabled value=""></option>
            @foreach ($microlocations as $ml)
                <option value="{{$ml->microlocation_id}}" {{isset($selected_microlocation_id) ? ($ml->microlocation_id == $selected_microlocation_id ? 'selected="selected"' : '') : ''}}>{{title_case($ml->microlocation_name)}}</option>
            @endforeach
        </select>
    </div>
    <div class="col-sm-10">
        {{DB::table('microlocations')->where('microlocation_id',Auth::user()->user_microlocation_id)->first()->microlocation_name}}
    </div>
</div>