@extends('layouts.macrolocation')
@section('content')
    <div id="content" class="row">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3>Create a microlocation </h3>
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
                <form method="post" action="community-store">
                    @csrf
                    <div class="form-group">
                        <label for="city">Community city:&nbsp</label>
                        <input type="text" maxlength="50" class="form-control" name="city" value="">
                    </div>
                    <button type="submit" class="btn btn-primary">Save</button>
                    <button id="cancel" type="button" class="btn" onclick="location.href='{{url()->previous()}}';">Cancel</button>
                </form>
            </div>
        </div>
    </div>
@endsection