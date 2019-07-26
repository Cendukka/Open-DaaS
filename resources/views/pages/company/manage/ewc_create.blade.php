@extends('layouts.default')
@section('content')
    <div id="content" class="row">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3>Create EWC Code </h3>
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
                <form method="post" action="ewc-store">
                    @csrf
                    <div class="form-group">
                        <label for="ewc_code">EWC Code:&nbsp</label>
                        <input type="text" class="form-control" maxlength="6" name="ewc_code"/>
                    </div>
                    <div class="form-group">
                        <label for="description">Description:&nbsp</label>
                        <textarea type="text" class="form-control" rows="8" maxlength="191" name="description"></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">Save</button>
                    <button id="cancel" type="button" class="btn" onclick="location.href='{{url('/ewc')}}';">Cancel</button>
                </form>
            </div>
        </div>
    </div>
@endsection