<div class="form-group row">
    <label class="col-sm-2 col-form-label" for="user">Käyttäjä:</label>
    <div class="col-sm-10">
        <select class="form-control element-width-auto form-field-width" name="user">
            @foreach ($users as $user)
                <option value="{{$user->user_id}}" {{isset($selected_user_id) ? ($user->user_id == $selected_user_id ? 'selected="selected"' : '') : ''}}>{{title_case($user->last_name.' '.$user->first_name)}}</option>
            @endforeach
        </select>
    </div>
</div>