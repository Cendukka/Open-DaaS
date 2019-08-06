<div class="form-group row">
    <label class="col-sm-2 col-form-label" for="user">Käyttäjä:</label>
    <div class="col-sm-10">
        @if(Auth::user()->user_type_id < 3)
            <select class="form-control element-width-auto form-field-width" name="user">
                <option selected="selected" hidden disabled value=""></option>
                @foreach ($users as $user)
                    <option value="{{$user->user_id}}" {{isset($selected_user_id) ? ($user->user_id == $selected_user_id ? 'selected="selected"' : '') : ''}}>{{title_case($user->last_name.' '.$user->first_name)}}</option>
                @endforeach
            </select>
        @else
            @php
            if(isset($selected_user_id)){
                $user = DB::table('users')->where('user_id',$selected_user_id)->first();
            }
            else{
                $user = Auth::user();
            }
            echo title_case($user->last_name.' '.$user->first_name);
            @endphp
        @endif
    </div>
</div>