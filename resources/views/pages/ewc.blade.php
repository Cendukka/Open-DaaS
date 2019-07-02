@extends('layouts.default')
@section('content')
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3>EWC Codes </h3>
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
                <div class="form-group">
                    <input type="text" class="form-controller" id="search" name="search">
                </div>
                <table class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>EWC Code</th>
                        <th>Description</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
                <form action="{{url(url()->current().'/create')}}">
                    <button type="submit" class="btn btn-secondary">+ Add EWC Code</button>
                </form>
            </div>
        </div>
    </div>
    @include('includes.search_script')
@endsection