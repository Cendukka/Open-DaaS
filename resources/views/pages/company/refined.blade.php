@extends('layouts.macrolocation')
@section('content')
    <div id="macrolocation_name" class="row">
        @include('includes.macrolocation_name')
    </div>
    <div id="content" class="row">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3>Refined Sorting </h3>
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <div class="col-sm-6">
                        <label for="from-date">From Date: </label>
                        <input type="date" class="form-control datepicker-autoclose" id="from-date" name="from-date" value="{{date('Y-m-d', strtotime("-12 months", strtotime(date('Y-m-d'))))}}">
                    </div>
                    <div class="col-sm-6">
                        <label for="to-date">To Date: </label>
                        <input type="date" class="form-control datepicker-autoclose" id="to-date" name="to-date" value="{{date('Y-m-d')}}">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-8">
                        <label for="search">Search: </label>
                        <input type="text" class="form-controller" id="search" name="search" placeholder="Search">
                    </div>
                </div>
                <table class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>Location</th>
                        <th>Date</th>
                        <th>Weight</th>
                        <th>Material</th>
                        <th>User</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @include('includes.search_script')
@endsection