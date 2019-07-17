@extends('layouts.default')
@section('content')
    <div id="content" class="row">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3>Edit EWC Code </h3>
            </div>
            <div class="panel-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form method="post" action="ewc-update">
                    @csrf
                    <div class="form-group">
                        <label for="ewc_code">EWC Code:&nbsp</label>
                        <input type="text" class="form-control" maxlength="6" name="ewc_code" disabled value="{{$ewc_code->ewc_code}}"/>
                    </div>
                    <div class="form-group">
                        <label for="description">Description:&nbsp</label>
                        <textarea type="text" class="form-control" rows="8" maxlength="191" name="description">{{$ewc_code->description}}</textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
                <br>
                <form method="post" action="ewc-destroy">
                    @csrf
                    @if (!(count($ewc_code->inventory_issue_details)>0 || count($ewc_code->inventory_receipt)>0))
                        <button type="submit" class="btn btn-primary">Delete</button>
                    @else
                        <button type="submit" class="btn btn-secondary" disabled>Delete</button>
                    @endif
                </form>
            </div>
        </div>
    </div>
@endsection