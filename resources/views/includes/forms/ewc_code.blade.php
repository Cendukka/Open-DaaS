<div class="form-group row">
    <label class="col-sm-2 col-form-label" for="ewc">EWC-Koodi:</label>
    <div class="col-sm-10">
        <select class="form-control element-width-auto form-field-width" name="ewc">
            <option value="" selected="selected" hidden disabled value=""></option>
            @foreach (DB::table('ewc_codes')->get() as $ewc)
                <option {{isset($code) ? ($code == $ewc->ewc_code ? 'selected="selected"' : '') : ''}} value="{{$ewc->ewc_code}}">{{title_case($ewc->ewc_code)}}</option>
            @endforeach
        </select>
    </div>
</div>