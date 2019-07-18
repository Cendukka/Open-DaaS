@extends('layouts.macrolocation')
@section('content')
    <div id="content" class="row">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3>Edit a microlocation </h3>
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
                @php
                    $communities = DB::table('community')
                        ->where('community_company_id','=',$company->company_id)
                        ->get();
                @endphp
                @if(count($communities)==0)
                    <h4>Community not found</h4>
                @else
                    <form method="post" action="community-store">
                        @csrf
                        <div class="form-group">
                            <label for="city">Community city:&nbsp</label>
                            <input type="text" maxlength="50" class="form-control" name="city" value="">
                        </div>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                @endif
            </div>
        </div>
    </div>
@endsection